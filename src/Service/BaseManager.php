<?php


namespace DotIt\SmsSendingBundle\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseManager
{
    protected static $baseUrl = 'https://www.tunisiesms.tn/client/Api/Api.aspx';
    protected static $key;
    protected static $sender;
    protected static $container;
    public function __construct(ContainerInterface $container)
    {
        self::$key= $container->getParameter('sms_key');
        self::$sender = $container->getParameter('sender');
        self::$container = $container;
    }

    protected static function getSendSms($mobile,$message,$date=null)
    {
        $url = self::$baseUrl.'?fct=sms&key='.self::$key
            .'&mobile='.$mobile.
            '&sms='.$message.
            '&sender='.self::$sender.
            '&date='.$date
        ;
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'GET');
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        return $curl;
    }


}