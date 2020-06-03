<?php


namespace DotIt\SmsSendingBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DotIt\SmsSendingBundle\Entity\BaseEntity as BaseEntity;
class CampaignSms extends BaseEntity
{
    protected $id;
    protected $message;
    protected $status = 'in progress';
    protected $date;
    protected $heure;
    protected $campaignMobiles;

    public function __construct()
    {
        $this->campaignMobiles = new ArrayCollection();
    }

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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
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
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param mixed $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * @return Collection | CampaignMobile
     */
    public function getCampaignMobiles()
    {
        return $this->campaignMobiles;
    }
    public function addCampaignMobile(CampaignMobile $campaignMobile)
    {
        if(!$this->campaignMobiles->contains($campaignMobile))
        {
            $this->campaignMobiles[] = $campaignMobile;
            $campaignMobile->setCampaignSms($this);
        }
        return $this;
    }








}