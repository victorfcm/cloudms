<?php

namespace CMS\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="front_index")
     * @Template()
     */
    public function indexAction()
    {
        $this->setMenu();
        
        return array('links' => array(
            'Admin' => $this->generateUrl('post_cindex'),
            'Master' => $this->generateUrl('post')
            ),
            'pages' => $this->pages,
            'postTypes' => $this->postTypes
            );
    }
    
    /**
     * @Route("/page/{id}", name="front_page")
     * @Template()
     */
    public function pageAction($id)
    {
        $this->setMenu();
        
        $em = $this->getDoctrine()->getManager();
        
        $page = $em->getRepository("CMSStoreBundle:Post")->find($id);
        
        return array('page' => $page,
            'pages' => $this->pages,
            'postTypes' => $this->postTypes
            );
    }
    
    /**
     * @Route("/posttype/{id}", name="front_post_type")
     * @Template()
     */
    public function postTypeAction($id)
    {
        $this->setMenu();
        
        $em = $this->getDoctrine()->getManager();
        
        $postType = $em->getRepository("CMSStoreBundle:PostType")->find($id);
        
        return array('postType' => $postType,
            'pages' => $this->pages,
            'postTypes' => $this->postTypes
            );
    }
    
    private function setMenu()
    {
        $this->getPages();
        $this->getPostTypes();
    }
    
    
    private function getPages()
    {
        $em = $this->getDoctrine()->getManager();
        
        $pageType = $em->getRepository('CMSStoreBundle:PostType')->findOneByName('page');
        $pages = $em->getRepository('CMSStoreBundle:Post')
            ->createQueryBuilder('p')
            ->where('p.daddyId IS NULL')
            ->andWhere('p.postType = :pt')
            ->setParameter('pt', $pageType->getId())
            ->getQuery()
            ->execute();
        
        $this->pages = $pages;
    }
    
    private function getPostTypes()
    {
        $em = $this->getDoctrine()->getManager();
        
        $pageTypes = $em->getRepository('CMSStoreBundle:PostType')
            ->createQueryBuilder('p')
            ->where('p.inMenu = true')
            ->andWhere('p.name != :page')
            ->setParameter('page', 'page')
            ->getQuery()
            ->execute();
        
        $this->postTypes = $pageTypes;
    }
    
    public function getTemplate($postType, $templateType = 'new')
    {
        $filename = $templateType . '.' . $postType;
        $root = $this->get('kernel')->getRootDir();

        $fs = new Filesystem();
        return $fs->exists("$root/../src/CMS/SiteBundle/Resources/views/Post/$filename.html.twig");
    }
}

