<?php

namespace DotIt\SmsSendingBundle;

use DotIt\SmsSendingBundle\Entity\CampaignMobile;
use DotIt\SmsSendingBundle\Entity\CampaignSms;
use DotIt\SmsSendingBundle\Service\BaseManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SmsSendingManager extends BaseManager
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }
    public static function  sendMultipleSms(array $mobiles,$message,$date=null,$heure=null)
    {
        if(!$date)
        {
            $date = date("d/m/Y");
        }
        if(!$heure)
        {
            $heure = date("H:i");
            //$heure=date("H:i:s",strtotime(date("H:i:s")." +3 minutes"));

        }

        $campaignSms = new CampaignSms();
        $campaignSms->setDate($date);
        $campaignSms->setHeure($heure);
        $campaignSms->setMessage($message);
        self::$container->get('doctrine')->getManager()->persist($campaignSms);
        $error = false;
        foreach ($mobiles as $mobile)
        {
            $campaignMobile = new CampaignMobile();
            $campaignMobile->setMobile($mobile);
            $message = str_replace(' ','+',$message);
            $curl = self::getSendSms($mobile,$message,$date);
            $result = curl_exec($curl);
            $result = str_replace('<![CDATA[',"",$result);
            $result = str_replace(']]>',"",$result);
            $xml = simplexml_load_string($result);
            $json = json_encode($xml);
            $res = json_decode($json,TRUE);
            $campaignMobile->setStatus($res['status']['status_msg']);
            if($res['status']['status_code']!=="200")
                $error = $res['status']['status_msg'];
            self::$container->get('doctrine')->getManager()->persist($campaignMobile);
            $campaignSms->addCampaignMobile($campaignMobile);
            curl_close($curl);

        }
        if($error)
            $campaignSms->setStatus($error);
        else
            $campaignSms->setStatus('success');
        self::$container->get('doctrine')->getManager()->persist($campaignSms);
        self::$container->get('doctrine')->getManager()->flush();

    }
    public static function resendCampaign($id)
    {
        $campaignSms = self::$container->get('doctrine')
            ->getManager()
            ->getRepository(CampaignSms::class)->findOneBy(array('id' => $id));
        $error = false;
        foreach ( $campaignSms->getCampaignMobiles() as $mobile)
        {
            if($mobile->getStatus()!=='OK')
            {
                $curl = self::getSendSms($mobile->getMobile(),$campaignSms->getMessage(),date('Y-m-d'));
                $result = curl_exec($curl);
                $result = str_replace('<![CDATA[',"",$result);
                $result = str_replace(']]>',"",$result);
                $xml = simplexml_load_string($result);
                $json = json_encode($xml);
                $res = json_decode($json,TRUE);
                $mobile->setStatus($res['status']['status_msg']);
                if($res['status']['status_code']!=="200")
                    $error = $res['status']['status_msg'];
                self::$container->get('doctrine')->getManager()->persist($mobile);

            }
        }
        if($error)
            $campaignSms->setStatus($error);
        else
            $campaignSms->setStatus('success');

        self::$container->get('doctrine')->getManager()->persist($campaignSms);
        self::$container->get('doctrine')->getManager()->flush();

    }
}
