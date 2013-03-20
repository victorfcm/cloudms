<?php
namespace CMS\StoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array('depth' => 2));

        $menu->addChild('Home', array('route' => 'post'));
        $menu->addChild('About Me', array(
            'route' => 'post',
            'routeParameters' => array('id' => 42)
        ));
        
        $menu['About Me']->addChild('teste', array('route' => 'post'));

        return $menu;
    }
}