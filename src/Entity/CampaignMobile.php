<?php


namespace DotIt\SmsSendingBundle\Entity;

use DotIt\SmsSendingBundle\Entity\BaseEntity as BaseEntity;

class CampaignMobile extends BaseEntity
{
    protected $id;
    protected $mobile;
    protected $status;
    protected $campaignSms;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return CampaignSms
     */
    public function getCampaignSms()
    {
        return $this->campaignSms;
    }

    public function setCampaignSms(CampaignSms $campaignSms)
    {
        $this->campaignSms = $campaignSms;
        return $this;
    }



}