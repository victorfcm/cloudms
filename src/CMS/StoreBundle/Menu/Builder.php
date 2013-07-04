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
				'routeParameters' => array('id' => $item->getId()),
				'attributes' => array('id' => $item->getId(),
					'style' => 'page')
			));
			
			foreach ($this->getSubPages($item->getId()) as $child)
			{
				$menu[$item->getTitle()]->addChild(
					$child->getTitle(), array(
					'route' => 'post_cedit',
					'routeParameters' => array('id' => $child->getId()),
					'attributes' => array('id' => $child->getId(),
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
                    'routeParameters' => array('id' => $postType->getId()),
                    'attributes' =>
                    array(
                        'id' => $postType->getId(),
                        'style' => 'postType',
                        'type' => strtolower($postType->getName()),
                        'taxonomy' => (isset($tax)) ? $tax : null
                    )
                )
            );
        }

        return $menu;
    }

    private function getPostTypes()
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $qry = $em->getRepository('CMSStoreBundle:PostType')
            ->createQueryBuilder('pt')
            ->where('pt.inMenu = true')
            ->andWhere('pt.name != :name')
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
