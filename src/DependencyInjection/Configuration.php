<?php


namespace DotIt\SmsSendingBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sms_sending');
        $rootNode
            ->children()
            ->scalarNode('sms_key')->defaultValue('')->end()
            ->scalarNode('sender')->defaultValue('')->end()
            ;
        return $rootNode;
    }


}