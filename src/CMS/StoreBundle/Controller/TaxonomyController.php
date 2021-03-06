<?php

namespace CMS\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Entity\Taxonomy;
use CMS\StoreBundle\Form\TaxonomyType;

/**
 * Taxonomy controller.
 *
 * @Route("/taxonomy")
 */
class TaxonomyController extends Controller
{
    /**
     * Lists all Taxonomy entities.
     *
     * @Route("/", name="taxonomy")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSStoreBundle:Taxonomy')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Taxonomy entity.
     *
     * @Route("/", name="taxonomy_create")
     * @Method("POST")
     * @Template("CMSStoreBundle:Taxonomy:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Taxonomy();
        $form = $this->createForm(new TaxonomyType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('taxonomy_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Taxonomy entity.
     *
     * @Route("/new", name="taxonomy_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Taxonomy();
        $form   = $this->createForm(new TaxonomyType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Taxonomy entity.
     *
     * @Route("/{id}", name="taxonomy_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:Taxonomy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Taxonomy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Taxonomy entity.
     *
     * @Route("/{id}/edit", name="taxonomy_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:Taxonomy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Taxonomy entity.');
        }

        $editForm = $this->createForm(new TaxonomyType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Taxonomy entity.
     *
     * @Route("/{id}", name="taxonomy_update")
     * @Method("PUT")
     * @Template("CMSStoreBundle:Taxonomy:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:Taxonomy')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Taxonomy entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TaxonomyType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('taxonomy_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Taxonomy entity.
     *
     * @Route("/{id}", name="taxonomy_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSStoreBundle:Taxonomy')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Taxonomy entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('taxonomy'));
    }

    /**
     * Creates a form to delete a Taxonomy entity by id.
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
