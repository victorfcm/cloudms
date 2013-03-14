<?php

namespace CMS\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Entity\TermTaxonomyRelashionship;
use CMS\StoreBundle\Form\TermTaxonomyRelashionshipType;

/**
 * TermTaxonomyRelashionship controller.
 *
 * @Route("/term-taxonomy")
 */
class TermTaxonomyRelashionshipController extends Controller
{
    /**
     * Lists all TermTaxonomyRelashionship entities.
     *
     * @Route("/", name="term-taxonomy")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSStoreBundle:TermTaxonomyRelashionship')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new TermTaxonomyRelashionship entity.
     *
     * @Route("/", name="term-taxonomy_create")
     * @Method("POST")
     * @Template("CMSStoreBundle:TermTaxonomyRelashionship:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new TermTaxonomyRelashionship();
        $form = $this->createForm(new TermTaxonomyRelashionshipType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('term-taxonomy_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new TermTaxonomyRelashionship entity.
     *
     * @Route("/new", name="term-taxonomy_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TermTaxonomyRelashionship();
        $form   = $this->createForm(new TermTaxonomyRelashionshipType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TermTaxonomyRelashionship entity.
     *
     * @Route("/{id}", name="term-taxonomy_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:TermTaxonomyRelashionship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TermTaxonomyRelashionship entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TermTaxonomyRelashionship entity.
     *
     * @Route("/{id}/edit", name="term-taxonomy_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:TermTaxonomyRelashionship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TermTaxonomyRelashionship entity.');
        }

        $editForm = $this->createForm(new TermTaxonomyRelashionshipType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing TermTaxonomyRelashionship entity.
     *
     * @Route("/{id}", name="term-taxonomy_update")
     * @Method("PUT")
     * @Template("CMSStoreBundle:TermTaxonomyRelashionship:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:TermTaxonomyRelashionship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TermTaxonomyRelashionship entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TermTaxonomyRelashionshipType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('term-taxonomy_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TermTaxonomyRelashionship entity.
     *
     * @Route("/{id}", name="term-taxonomy_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSStoreBundle:TermTaxonomyRelashionship')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TermTaxonomyRelashionship entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('term-taxonomy'));
    }

    /**
     * Creates a form to delete a TermTaxonomyRelashionship entity by id.
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
