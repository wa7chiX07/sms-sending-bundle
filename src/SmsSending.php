<?php

namespace DotIt\SmsSendingBundle;

use DotIt\SmsSendingBundle\Service\BaseManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SmsSending extends BaseManager
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
    }
    public static function  sendMultipleSms()
    {
    }
}