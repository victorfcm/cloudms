<?php

namespace CMS\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Controller\PostController as Controller;
use CMS\StoreBundle\Entity\PostType;
use CMS\StoreBundle\Entity\PostAttachment;
use CMS\StoreBundle\Form\PostAttachmentType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType as HiddenType;
use CMS\StoreBundle\Filter\PostFilterType;
use CMS\StoreBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;

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
     * @Route("/list/{typeId}", name="post_cindex")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function indexAction($typeId = null)
    {
		if($this->get('request')->request->has('submit-filter'))
		{
			$typeId = $this->get('request')->get('cms_storebundle_termfilter');
			$typeId = $typeId['typeId'];
		}
		
        $em = $this->getDoctrine()->getManager();

        $postType = $em->getRepository('CMSStoreBundle:PostType')->findOneBySlug($typeId);
        $filterBuilder = $em->getRepository('CMSStoreBundle:Post')->findByPostType($postType->getId());

        $taxonomy = $postType->getTaxonomy();

        $form_filter = $this->get('form.factory')->create(new PostFilterType());

        if ($this->get('request')->request->has('submit-filter'))
        {
            // bind values from the request
            $form_filter->bind($this->get('request'));

            // initliaze a query builder
            $filterBuilder = $em->getRepository('CMSStoreBundle:Post')
                ->createQueryBuilder('p')
                ->where('p.postType = :postType')
                ->orderBy('p.createdAt', 'DESC')
                ->setParameter('postType', $typeId);

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form_filter, $filterBuilder);
        }
        else
        {
			$form_filter->add('typeId', 'hidden', array('attr' => array('value' => $typeId)));
		}

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $filterBuilder, $this->get('request')->query->get('page', 1), 5
        );

        $return = array(
            'entities' => $pagination,
            'postType' => $postType->getName(),
            'taxonomy' => (isset($taxonomy)) ? $taxonomy : null,
            'pagination' => $pagination,
            'form_filter' => $form_filter->createView(),
            'postTypeSlug' => $postType->getSlug()
        );
              
        if ($this->getTemplate($postType->getSlug(), 'index'))
        {
            $return = $this->renderView(
                "CMSAdminBundle:Post:index.".$postType->getSlug().".html.twig", $return);

            return new Response($return);
        }
        else
        {
            return $return;
        }
    }

    /**
     * Creates a new Post entity.
     *
     * @Route("/", name="post_ccreate")
     * @Method("POST")
     * @Template("CMSAdminBundle:Post:new.html.twig")
     */
    public function createAction(Request $request, $redirUrl = 'post_cindex')
    {
        return parent::createAction($request, $redirUrl);
    }

    /**
     * Displays a form to create a new Post entity.
     *
     * @Route("/new/{type}/{daddyId}", name="post_cnew")
     * @Method("GET")
     * @Template()
     */
    public function newAction($type = null, $daddyId = null)
    {
        $em = $this->getDoctrine()->getManager();
        $postType = $em->getRepository('CMSStoreBundle:PostType')->findOneBySlug($type);
        $daddy = $em->getRepository('CMSStoreBundle:Post')->findOneBySlug($daddyId);        
        
        $entity = new Post();
        $form = $this->createForm(new \CMS\StoreBundle\Form\PostType(array('postType' => $postType)), $entity);
        $postTypeName = 'post';

        if (null !== $type && $postType)
        {
            $form->remove('postType');
            $form->add('postType', new HiddenType(), array('attr' => array('value' => $postType->getId())));
            $postTypeName = $postType->getSlug();
        }

        $form->remove('userId');
        $form->add('userId', new HiddenType(), array('attr' => array('value' => $this->getUser()->getId())));
        
        if(!$postType->getTaxonomy())
        {
			$form->remove('terms');
		}
        
        $form->remove('children');
        $form->remove('daddy');

        if (null !== $daddyId)
        {
            $form->add('daddy', new HiddenType(), array('attr' => array('value' => $daddy->getId())));
        }

		$up_entity = new PostAttachment();
        $up_form   = $this->createForm(new PostAttachmentType(), $up_entity);
		
		$return = array(
                'entity' => $entity,
                'form' => $form->createView(),
                'up_form' => $up_form->createView(),
                'postType' => $postTypeName
                );
		
        if ($this->getTemplate($postType))
        {
            $return = $this->renderView(
                "CMSAdminBundle:Post:new.$ar[postType].html.twig", $return);

            return new Response($return);
        }
        else
        {
            return $return;
        }
    }

    public function getTemplate($postType, $templateType = 'new')
    {
		#TODO: do this in a better way
        $filename = $templateType . '.' . $postType;
        $root = $this->get('kernel')->getRootDir();

        $fs = new Filesystem();
        return $fs->exists("$root/../src/CMS/AdminBundle/Resources/views/Post/$filename.html.twig");
    }

    /**
     * Finds and displays a Post entity.
     *
     * @Route("/{id}", name="post_cshow")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        return parent::showAction($id);
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     * @Route("/edit/{id}", name="post_cedit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('CMSStoreBundle:Post')->findOneBySlug($id);
        
        $ar = parent::editAction($post->getId());
        $form = $ar['default_form'];

        $ar['postType'] = $post->getPostType()->getSlug();

        $form->remove('postType');
        $form->add('postType', 'entity', array('class' => 'CMS\StoreBundle\Entity\PostType',
            'attr' => array('style' => 'display:none'),
            'label_attr' => array('style' => 'display:none')
        ));

        $form->remove('userId');
        $form->add('userId', 'entity', array('class' => 'CMS\StoreBundle\Entity\User',
            'attr' => array('style' => 'display:none'),
            'label_attr' => array('style' => 'display:none')
        ));

        $form->remove('children');
        $form->add('children', 'entity', array('class' => 'CMS\StoreBundle\Entity\Post',
            'attr' => array('style' => 'display:none'),
            'label_attr' => array('style' => 'display:none'),
            'empty_value' => 'escolha'
        ));
        
        $form->remove('daddy');
        $form->add('daddy', 'entity', array('class' => 'CMS\StoreBundle\Entity\Post',
            'attr' => array('style' => 'display:none'),
            'label_attr' => array('style' => 'display:none'),
            'empty_value' => 'escolha'
        ));
        
        if(!$post->getPostType()->getTaxonomy())
        {
			$form->remove('terms');
		}
		
		$up_entity = new PostAttachment();
        $up_form   = $this->createForm(new PostAttachmentType(), $up_entity);
        
        $ar['edit_form'] = $form->createView();
		$ar['up_form'] = $up_form->createView();

        if ($this->getTemplate($ar['postType'], 'edit'))
        {
            $return = $this->renderView(
                "CMSAdminBundle:Post:edit.$ar[postType].html.twig", array(
                'entity' => $ar['entity'],
                'edit_form' => $ar['edit_form'],
                'up_form' => $ar['up_form'],
                'delete_form' => $ar['delete_form'],
                'postType' => $ar['postType']
                ));

            return new Response($return);
        }
        else
        {
            return $ar;
        }
    }

    /**
     * Edits an existing Post entity.
     *
     * @Route("/{id}", name="post_cupdate")
     * @Method("PUT")
     * @Template("CMSStoreBundle:Post:edit.html.twig")
     */
    public function updateAction(Request $request, $id, $redirUrl = 'post_cedit')
    {		
        $this->get('session')->setFlash(
            'notice', 'Alteração salva com sucesso!'
        );

        return parent::updateAction($request, $id, $redirUrl);
    }

    /**
     * Deletes a Post entity.
     *
     * @Route("/delete/{id}", name="post_cdelete")
     * @Method({"DELETE", "GET"})
     */
    public function deleteAction(Request $request, $id, $redirUrl = 'post_cindex')
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSStoreBundle:Post')->findOneBySlug($id);

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        
        $posttype = $entity->getPostType();
        
        $em->remove($entity);
        $em->flush();
        
        return $this->redirect($this->generateUrl($redirUrl, array('typeId' => $posttype->getSlug())));
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
        return parent::createDeleteForm($id);
    }

}
