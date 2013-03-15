<?php

namespace CMS\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Controller\TermController as Controller;



/**
 * Term controller.
 *
 * @Route("/term")
 */
class TermController extends Controller
{
    /**
     * Lists all Term entities.
     *
     * @Route("/", name="term_tindex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return parent::indexAction();
    }
    
    /**
     * Creates a new Term entity.
     *
     * @Route("/", name="term_tcreate")
     * @Method("Post")
     * @Template("CMSStoreBundle:Term:new.html.twig")
     */
    public function createAction(Request $request, $redirUrl = 'term_tcreate')
    {
        return parent::createAction($request, $redirUrl);
    }

    /**
     * Displays a form to create a new Term entity.
     *
     * @Route("/new", name="term_tnew")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        return parent::newAction();
    }

    /**
     * Finds and displays a Term entity.
     *
     * @Route("/{id}", name="term_tshow")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        return parent::showAction($id);
    }

    /**
     * Displays a form to edit an existing Term entity.
     *
     * @Route("/{id}/edit", name="term_tedit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        return parent::editAction($id);
    }

    /**
     * Edits an existing Term entity.
     *
     * @Route("/{id}", name="term_tupdate")
     * @Method("PUT")
     * @Template("CMSStoreBundle:Term:edit.html.twig")
     */
    public function updateAction(Request $request, $id, $redirUrl = 'term_tupdate')
    {
        return parent::updateAction($request, $id, $redirUrl);
    }

    /**
     * Deletes a Term entity.
     *
     * @Route("/{id}", name="term_tdelete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id, $redirUrl = 'term_tdelete')
    {
        return parent::deleteAction($request, $id, $redirUrl);
    }

    /**
     * Creates a form to delete a Term entity by id.
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
