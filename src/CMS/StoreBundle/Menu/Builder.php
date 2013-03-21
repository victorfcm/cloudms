<?php
namespace CMS\StoreBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use CMS\StoreBundle\Entity\PostType;

class Builder extends ContainerAwareCommand
{
    public function __construct()
    {
        $name = 'doctrine';
        parent::__construct($name);
    }
    
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array('depth' => 2));
        
        $em = $this->getContainer()->get('doctrine')->getManager();
        $qry = $em->createQuery('SELECT p FROM CMSStoreBundle:Post p WHERE p.postType = :type_page and p.daddyId IS NULL ORDER BY p.id DESC')->setParameter('type_page', PostType::$page_type_id);
        
        $itens = $qry->getResult();
        
        foreach($itens as $item)
        {
            $menu->addChild(
                $item->getTitle(), 
                array(
                    'route' => 'post_cshow',
                    'routeParameters' => array('id' => $item->getId()),
                    'attributes' => array('id' => $item->getId(),
                    'style' => 'page')
                    ));
            
            $qry = $em->createQuery('SELECT p FROM CMSStoreBundle:Post p WHERE p.children = :id ORDER BY p.updatedAt DESC')->setParameter('id', $item->getId());
            $children = $qry->getResult();
            
            foreach($children as $child)
            {
                $menu[$item->getTitle()]->addChild(
                        $child->getTitle(),
                        array(
                            'route' => 'post_cshow',
                            'routeParameters' => array('id' => $child->getId()),
                            'attributes' => array('id' => $child->getId(), 
                            'style' => 'pageChild')
                            )
                    );
            }
        }
        
        $qry = $em->createQuery('SELECT pt FROM CMSStoreBundle:PostType pt WHERE pt.id != :type_page')->setParameter('type_page', PostType::$page_type_id);
        $postTypes = $qry->getResult();
        
        foreach($postTypes as $postType)
        {
            $menu->addChild(
                $postType->getName(), 
                array(
                    'route' => 'term_show', 
                    'routeParameters' => array('id' => $postType->getId()),
                    'attributes' => 
                      array(
                        'id' => $postType->getId(), 
                        'style' => 'postType',
                        'type' => strtolower($postType->getName())
                       )
                    )
                );
        }

        return $menu;
    }
}