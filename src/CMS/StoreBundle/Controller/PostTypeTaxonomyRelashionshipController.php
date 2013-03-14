<?php

namespace CMS\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Entity\PostTypeTaxonomyRelashionship;
use CMS\StoreBundle\Form\PostTypeTaxonomyRelashionshipType;

/**
 * PostTypeTaxonomyRelashionship controller.
 *
 * @Route("/post_type-taxonomy")
 */
class PostTypeTaxonomyRelashionshipController extends Controller
{
    /**
     * Lists all PostTypeTaxonomyRelashionship entities.
     *
     * @Route("/", name="post_type_tax_rl")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSStoreBundle:PostTypeTaxonomyRelashionship')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new PostTypeTaxonomyRelashionship entity.
     *
     * @Route("/", name="post_type_tax_rl_create")
     * @Method("POST")
     * @Template("CMSStoreBundle:PostTypeTaxonomyRelashionship:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new PostTypeTaxonomyRelashionship();
        $form = $this->createForm(new PostTypeTaxonomyRelashionshipType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_type_tax_rl_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new PostTypeTaxonomyRelashionship entity.
     *
     * @Route("/new", name="post_type_tax_rl_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PostTypeTaxonomyRelashionship();
        $form   = $this->createForm(new PostTypeTaxonomyRelashionshipType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PostTypeTaxonomyRelashionship entity.
     *
     * @Route("/{id}", name="post_type_tax_rl_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostTypeTaxonomyRelashionship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostTypeTaxonomyRelashionship entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PostTypeTaxonomyRelashionship entity.
     *
     * @Route("/{id}/edit", name="post_type_tax_rl_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostTypeTaxonomyRelashionship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostTypeTaxonomyRelashionship entity.');
        }

        $editForm = $this->createForm(new PostTypeTaxonomyRelashionshipType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing PostTypeTaxonomyRelashionship entity.
     *
     * @Route("/{id}", name="post_type_tax_rl_update")
     * @Method("PUT")
     * @Template("CMSStoreBundle:PostTypeTaxonomyRelashionship:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostTypeTaxonomyRelashionship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostTypeTaxonomyRelashionship entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PostTypeTaxonomyRelashionshipType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_type_tax_rl_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a PostTypeTaxonomyRelashionship entity.
     *
     * @Route("/{id}", name="post_type_tax_rl_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSStoreBundle:PostTypeTaxonomyRelashionship')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PostTypeTaxonomyRelashionship entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('post_type_tax_rl'));
    }

    /**
     * Creates a form to delete a PostTypeTaxonomyRelashionship entity by id.
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
