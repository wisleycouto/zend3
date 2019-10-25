<?php

namespace Post;

use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\ModuleManager\Feature\configProviderInterface;


class Module implements configProviderInterface
{
    const VERSION = '3.0.3-dev';

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiveConfig(){

    	return [
    		'factories' => [
    			Model\PostTable::class => function($container){
    				$tableGateway = $container ->get(Model\PostTableGateway::class);
    				return new Model\PostTable($tableGateway);
    			},
    			Model\PostTableGateway::class => function($container){

    				$adapter = $container->get(adapterInterface::class);
    				$resultSetPrototype = new ResultSet();
    				$resultSetPrototype->setArrayObjectPrototype(new Model\Post);
    				return new tableGateway('post', $adapter, null, $resultSetPrototype);


    			}

    		]


    	];
    }

    public function getControllerConfig(){

    	return [
    		'factories' => [
    			Controller\IndexController::class => function($container){

    					return new Controller\IndexController($container->get(Model\PostTable::class));
    			}

    		]

    	];
    }
}
