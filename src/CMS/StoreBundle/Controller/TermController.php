<?php

namespace CMS\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Entity\Term;
use CMS\StoreBundle\Form\TermType;

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
     * @Route("/", name="term")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSStoreBundle:Term')->findAll();
		
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Term entity.
     *
     * @Route("/", name="term_create")
     * @Method("POST")
     * @Template("CMSStoreBundle:Term:new.html.twig")
     */
    public function createAction(Request $request, $redirUrl = 'term_clist')
    {    
        $em = $this->getDoctrine()->getManager();
        $entity  = new Term();
        $form = $this->createForm(new TermType(), $entity);
        $form->bind($request);
        
        ## Reverse add ##
        $tax = $entity->getTaxonomy();
        if(!$tax->hasTerm($entity))
        {
			$tax->addTerm($entity);
			$em->persist($tax);
		}
       
        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
			
            return $this->redirect($this->generateUrl($redirUrl, array('taxId' => $entity->getTaxonomy()->getSlug())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Term entity.
     *
     * @Route("/new", name="term_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Term();
        $form   = $this->createForm(new TermType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'default_form' => $form
        );
    }

    /**
     * Finds and displays a Term entity.
     *
     * @Route("/{id}", name="term_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:Term')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Term entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Term entity.
     *
     * @Route("/{id}/edit", name="term_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:Term')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Term entity.');
        }

        $editForm = $this->createForm(new TermType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Term entity.
     *
     * @Route("/{id}", name="term_update")
     * @Method("PUT")
     * @Template("CMSStoreBundle:Term:edit.html.twig")
     */
    public function updateAction(Request $request, $id, $redirUrl = 'term_edit')
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:Term')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Term entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TermType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl($redirUrl, array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Term entity.
     *
     * @Route("/{id}", name="term_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id, $redirUrl = 'term')
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSStoreBundle:Term')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Term entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl($redirUrl));
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
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
