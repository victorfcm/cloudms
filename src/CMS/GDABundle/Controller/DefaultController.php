<?php

namespace CMS\GDABundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
	private $in_maitence = false;
	
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {		
		if($this->in_maitence)
			return $this->redirect($this->generateUrl('maintence'));
			
        return $this->redirect($this->generateUrl('home'));
    }
    
    /**
     * @Route("/manutencao", name="maintence")
     * @Template()
     */
    public function manutencaoAction()
    {
		return array();
	}
	
    /**
     * @Route("/home", name="home")
     * @Template()
     */
    public function homeAction()
    {
		$news;
		$pics;
		$movies;
		$top;
		
		return array();
	}
	
	/**
	 * @Route("/post/{type}/{slug}", name="site_post")
	 * @Template()
	 */
	 public function postAction($slug)
	 {
		 $em = $this->getDoctrine()->getManager();
	     $post = $em->getRepository('CMSStoreBundle:Post')->findOneBySlug($slug);
	     
		 return array("post" => $post);
	 }
	
	/**
	 * @Route("/list/{slug}", name="site_term")
	 * @Template()
	 */
	 public function termAction($slug)
	 {
		 $em = $this->getDoctrine()->getManager();
	     $posttype = $em->getRepository('CMSStoreBundle:PostType')->findOneBySlug($slug);
		 
		 return array("postType" => $posttype);
	 }
}
