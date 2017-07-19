<?php

namespace twentysteps\Commons\UptimeRobotBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('twentysteps_commons_uptime_robot');
	
	    $rootNode
		    ->children()
		    ->scalarNode('api_key')->end()
		    ->end()
		    ->end()
	    ;
	    
        return $treeBuilder;
    }
}
