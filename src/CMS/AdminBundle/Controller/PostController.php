<?php

namespace CMS\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Controller\PostController as Controller;


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
     * @Route("/", name="post_cindex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return parent::indexAction();
    }
    
    /**
     * Creates a new Post entity.
     *
     * @Route("/", name="post_ccreate")
     * @Method("POST")
     * @Template("CMSStoreBundle:Post:new.html.twig")
     */
    public function createAction(Request $request, $redirUrl = 'post_ccreate')
    {
        return parent::createAction($request, $redirUrl);
    }

    /**
     * Displays a form to create a new Post entity.
     *
     * @Route("/new", name="post_cnew")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        return parent::newAction();
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
     * @Route("/{id}/edit", name="post_cedit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        return parent::editAction($id);
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
     * @Route("/{id}", name="post_cdelete")
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
