<?php

namespace CMS\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Entity\Term;
use CMS\StoreBundle\Entity\Post;
use CMS\StoreBundle\Entity\PostAttachment;
use CMS\StoreBundle\Form\PostType;
use CMS\StoreBundle\Form\PostAttachmentType;

/**
 * Post controller.
 *
 * @Route("/post")
 */
class PostController extends Controller
{
    /**
     * Lists all Post entities.
     *
     * @Route("/", name="post")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSStoreBundle:Post')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Post entity.
     *
     * @Route("/", name="post_create")
     * @Method("POST")
     * @Template("CMSStoreBundle:Post:new.html.twig")
     */
    public function createAction(Request $request, $redirUrl = 'post_show')
    {
        $em = $this->getDoctrine()->getManager();
        
        $entity  = new Post();
        $form = $this->createForm(new PostType(), $entity);
        $form->bind($request);
        
        $pt = $entity->getPostType()->getSlug();
        $t = $request->request->get('cms_storebundle_posttype');
        $form_terms = ($t['terms']) ? $t['terms']: array();
        $terms = $em->getRepository('CMSStoreBundle:Term')->findById($form_terms);
        $trm = '';
        
        foreach($terms as $term)
        {
			$trm .= $term->getName()."/";
		}
        
        ## Upload ##
        $upe = new PostAttachment();
        $upf = $this->createForm(new PostAttachmentType(), $upe);
        $upf->bind($request);
        
        $dir = "uploads/$pt/$trm";
        
        foreach($upf->getData()->getFileName() as $file)
        {
			if(null !== $file)
			{
				$attachment = new PostAttachment();
				$attachment->setPost($entity);
				$attachment->setMime($file->getMimeType());
				$attachment->setFileName($file->getClientOriginalName());
				$attachment->setPath($dir.''.$file->getClientOriginalName());
				
				$em->persist($attachment);
				
				$entity->addAttachment($attachment);
				
				$file->move($dir, $file->getClientOriginalName());
			}
		}
		
		## Terms ##
		foreach($terms as $term)
        {
			$term->addPost($entity);
			$entity->addTerm($term);
			
			$em->persist($term);
		}

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

			if($redirUrl == 'post_show')
				return $this->redirect($this->generateUrl($redirUrl, array('id' => $entity->getId())));
				
			return $this->redirect($this->generateUrl($redirUrl, array('typeId' => $entity->getPostType()->getSlug())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Post entity.
     *
     * @Route("/new", name="post_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Post();
        $form   = $this->createForm(new PostType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'form_front' => $form
        );
    }

    /**
     * Finds and displays a Post entity.
     *
     * @Route("/{id}", name="post_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/{id}/edit", name="post_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:Post')->find($id);
        $posttype = $em->getRepository('CMSStoreBundle:PostType')->find($entity->getPostType());

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createForm(new PostType(array('postType' => $posttype)), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'default_form' => $editForm
        );
    }

    /**
     * Edits an existing Post entity.
     *
     * @Route("/{id}", name="post_update")
     * @Method("PUT")
     * @Template("CMSStoreBundle:Post:edit.html.twig")
     */
    public function updateAction(Request $request, $id, $redirUlr = 'post_edit')
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:Post')->find($id);
		$entity->removeAllTerms();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PostType(array('em' => $entity)), $entity);
        $editForm->bind($request);

        $pt = $entity->getPostType()->getSlug();
        $trm = '';
        
        foreach($entity->getTerms() as $term)
        {
			$trm .= "$term/";
		}
        
        ## Upload ##
        $upe = new PostAttachment();
        $upf = $this->createForm(new PostAttachmentType(), $upe);
        $upf->bind($request);
        $dir = "uploads/$pt/$trm";
        
        foreach($upf->getData()->getFileName() as $file)
        {
			if(null !== $file)
			{
				$attachment = new PostAttachment();
				$attachment->setPost($entity);
				$attachment->setMime($file->getMimeType());
				$attachment->setFileName($file->getClientOriginalName());
				$attachment->setPath($dir.''.$file->getClientOriginalName());
				
				$em->persist($attachment);
				
				$entity->addAttachment($attachment);
				
				$file->move($dir, $file->getClientOriginalName());
			}
		}
		
		## Terms ##
		foreach($entity->getTerms() as $term)
        {
			if(!$term->hasPost($entity))
			{
				$term->addPost($entity);
				$em->persist($term);
			}
		}

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl($redirUlr, array('id' => $entity->getSlug())));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Post entity.
     *
     * @Route("/{id}", name="post_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id, $redirUrl = 'post')
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSStoreBundle:Post')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Post entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl($redirUrl));
    }

    /**
     * Creates a form to delete a Post entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
