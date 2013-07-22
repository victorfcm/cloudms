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
        $this->getPages();
        $this->getPostTypes();

		foreach ($this->pages as $item)
		{
			$menu->addChild(
				$item->getTitle(), array(
				'route' => 'post_cedit',
				'routeParameters' => array('id' => $item->getSlug()),
				'attributes' => array(
					'id' => $item->getSlug(),
					'style' => 'page',
                    'position' => $item->getPosition()
					)
			));
			
			foreach ($this->getSubPages($item->getId()) as $child)
			{
				$menu[$item->getTitle()]->addChild(
					$child->getTitle(), array(
					'route' => 'post_cedit',
					'routeParameters' => array('id' => $child->getSlug()),
					'attributes' => array('id' => $child->getSlug(),
						'style' => 'pageChild')
					)
				);
			}
		}

        foreach ($this->postTypes as $postType)
        {
            foreach ($postType->getTaxonomys() as $tax)
            {
                $tax = $tax->getTaxonomy();
                break;
            }

            $menu->addChild(
                $postType->getName(), array(
                    'route' => 'term_cedit',
                    'routeParameters' => array('id' => $postType->getSlug()),
                    'attributes' =>
                    array(
                        'id' => $postType->getSlug(),
                        'style' => 'postType',
                        'type' => $postType->getSlug(),
                        'taxonomy' => (isset($tax)) ? $tax : null,
                        'position' => $postType->getPosition()
                    )
                )
            );
        }
        
        $menu = $this->orderMenu($menu);

        return $menu;
    }
    
    private function orderMenu($menu)
    {
		$_holder = array();
		$count = count($menu->getChildren());
		
		foreach($menu->getChildren() as $child)
		{
			$actPos = $child->getAttributes()['position'];
			
			if(isset($_holder[$actPos]))
				$actPos = $count++;
			
			$_holder[$actPos] = $child;
		}
		
		ksort($_holder);
		
		$menu->setChildren($_holder);
		return $menu;
	}

    private function getPostTypes()
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $qry = $em->getRepository('CMSStoreBundle:PostType')
            ->createQueryBuilder('pt')
            ->where('pt.inMenu = true')
            ->andWhere('pt.name != :name')
			->orderBy('pt.position', 'ASC')
            ->setParameter('name', 'page');

        $itens = $qry->getQuery()->execute();

        $this->postTypes = $itens;
    }

    private function getPages()
    {
        $postTypes = array();
        $em = $this->getContainer()->get('doctrine')->getManager();
        $pts = $em->getRepository('CMSStoreBundle:PostType')->findByName('page');

		if(!empty($pts))
		{
			foreach ($pts as $posttype)
			{
				if ($posttype->isInMenu())
					$postTypes[] = $posttype->getId();
			}
			
			if(!empty($postTypes))
			{
				$qry = $em->getRepository('CMSStoreBundle:Post')
					->createQueryBuilder('p')
					->where('p.daddy IS NULL')
					->andWhere('p.postType IN (:postTypes)')
					->orderBy('p.position', 'ASC')
					->setParameter('postTypes', $postTypes);

				$itens = $qry->getQuery()->execute();

				$this->pages = $itens;
			}
			else
			{
				$this->pages = array();
			}
		}
		else
		{
			$this->pages = array();
		}
    }

    private function getSubPages($pageId)
    {
        return $this->getContainer()
                ->get('doctrine')
                ->getManager()
                ->getRepository('CMSStoreBundle:Post')
                ->findByDaddy($pageId);
    }

}
