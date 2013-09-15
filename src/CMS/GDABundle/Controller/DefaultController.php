<?php

namespace CMS\GDABundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;

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
	     $template = $this->getTemplate($post->getPostType()->getSlug());
	     
	     if($template)
	     {
            $content = $this->renderView(
				'CMSGDABundle:Default:'.$template,
				array('post' => $post)
			);
			
			return new Response($content);
		 }
	     
		 return array("post" => $post);
	 }
	
	/**
	 * @Route("/list/{slug}/{term}", name="site_term")
	 * @Template()
	 */
	 public function termAction($slug, $term = null)
	 {
		 $em = $this->getDoctrine()->getManager();
		 
		 if(null === $term)
		 {
			 $posttype = $em->getRepository('CMSStoreBundle:PostType')->findOneBySlug($slug);
			 $repository = $em->getRepository('CMSStoreBundle:Post');
			 $posts = $repository->createQueryBuilder('p')
						->where('p.postType = :postType')
						->orderBy('p.createdAt', 'DESC')
						->setParameter('postType', $posttype)
						->getQuery()
						->execute();
		 }
		 else
		 {
			 $term = $em->getRepository('CMSStoreBundle:Term')->findOneBySlug($term);
			 $posttype = $em->getRepository('CMSStoreBundle:Taxonomy')->findOneBySlug($slug);
			 $posts = $term->getPosts();
		 }
	     
	     $template = $this->getTemplate($slug, 'term');
	     if($template)
	     {
            $content = $this->renderView(
				'CMSGDABundle:Default:'.$template,
				array('postType' => $posttype, 'posts' => $posts, 'term' => $term)
			);
			
			return new Response($content);
		 }
		 
		 return array("postType" => $posttype, 'posts' => $posts, 'term' => $term);
	 }
	 
     private function getTemplate($postType, $templateType = 'post')
     {
         $filename = $templateType . '.' . $postType;
         $root = $this->get('kernel')->getRootDir();

         $fs = new Filesystem();
         if($fs->exists("$root/../src/CMS/GDABundle/Resources/views/Default/$filename.html.twig"))
         {
			 return $filename.".html.twig";
		 }
		 
		 return false;
     }
}
