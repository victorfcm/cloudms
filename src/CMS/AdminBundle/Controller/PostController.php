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
use Symfony\Component\Form\Extension\Core\Type\HiddenType as HiddenType;
use CMS\StoreBundle\Filter\PostFilterType;

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
        if (null === $typeId)
            $typeId = PostType::$news_type_id;

        $em = $this->getDoctrine()->getManager();

        $filterBuilder = $em->getRepository('CMSStoreBundle:Post')->findByPostType($typeId);
        $postType = $em->getRepository('CMSStoreBundle:PostType')->findOneById($typeId);

        foreach ($postType->getTaxonomys() as $tax)
        {
            $taxonomy = $tax->getTaxonomy();
        }
        
        $form_filter = $this->get('form.factory')->create(new PostFilterType());

        if ($this->get('request')->request->has('submit-filter'))
        {
            // bind values from the request
            $form_filter->bind($this->get('request'));

            // initliaze a query builder
            $filterBuilder = $em->getRepository('CMSStoreBundle:Post')
                ->createQueryBuilder('p')
                ->where('p.postType = :postType')
                ->setParameter('postType', $typeId);

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form_filter, $filterBuilder);
        }
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $filterBuilder, 
            $this->get('request')->query->get('page', 1),
            5
        );

        return array(
            'entities' => $pagination,
            'postType' => $postType->getName(),
            'taxonomy' => $taxonomy,
            'pagination' => $pagination,
            'form_filter' => $form_filter->createView()
        );
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
    public function newAction($daddyId = null, $type = null)
    {
        $ar = parent::newAction();
        $form = $ar['form_front'];
        $ar['postType'] = 'post';

        $em = $this->getDoctrine()->getManager();
        $postType = $em->getRepository('CMSStoreBundle:PostType')->findOneByName($type);

        if (null !== $type && $postType)
        {
            $form->remove('postType');
            $form->add('postType', new HiddenType(), array('attr' => array('value' => $postType->getId())));
            $ar['postType'] = strtolower($postType->getName());
        }

        $form->remove('userId');
        $form->add('userId', new HiddenType(), array('attr' => array('value' => $this->getUser()->getId())));

        $form->remove('children');

        if (null !== $daddyId)
        {
            $form->add('children', new HiddenType(), array('attr' => array('value' => $daddyId)));
        }

        $ar['form'] = $form->createView();
        
        if($this->getTemplate($ar['postType']))
        {
            $return = $this->renderView(
                "CMSAdminBundle:Post:new.$ar[postType].html.twig",
                array(
                    'entity' => $ar['entity'],
                    'form' => $ar['form'],
                    'postType' => $ar['postType']
                ));
            
            return new Response($return);
        }
        else
        {
            return $ar;
        }
    }
    
    public function getTemplate($postType, $templateType = 'new')
    {
        $filename = $templateType.'.'.$postType;
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
        $post = $em->getRepository('CMSStoreBundle:Post')->findOneById($id);
        
        $ar = parent::editAction($id);
        $form = $ar['default_form'];
        
        $ar['postType'] = strtolower($post->getPostType()->getName());

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
            'label_attr' => array('style' => 'display:none')
            ));

        $ar['edit_form'] = $form->createView();
        
        if($this->getTemplate($ar['postType'], 'edit'))
        {
            $return = $this->renderView(
                "CMSAdminBundle:Post:edit.$ar[postType].html.twig",
                array(
                    'entity' => $ar['entity'],
                    'edit_form' => $ar['edit_form'],
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
    public function updateAction(Request $request, $id, $redirUrl = 'post_cupdate')
    {
        return parent::updateAction($request, $id, $redirUrl);
    }

    /**
     * Deletes a Post entity.
     *
     * @Route("/delete/{id}", name="post_cdelete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id, $redirUrl = 'post_cdelete')
    {
        return parent::deleteAction($request, $id, $redirUrl);
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
