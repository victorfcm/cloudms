<?php

namespace CMS\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Entity\PostAttachment;
use CMS\StoreBundle\Form\PostAttachmentType;

/**
 * PostAttachment controller.
 *
 * @Route("/admin/attachments")
 */
class PostAttachmentController extends Controller
{
    /**
     * Lists all PostAttachment entities.
     *
     * @Route("/", name="attachments")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSStoreBundle:PostAttachment')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new PostAttachment entity.
     *
     * @Route("/", name="attachments_create")
     * @Method("POST")
     * @Template("CMSStoreBundle:PostAttachment:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new PostAttachment();
        $form = $this->createForm(new PostAttachmentType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attachments_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new PostAttachment entity.
     *
     * @Route("/new", name="attachments_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PostAttachment();
        $form   = $this->createForm(new PostAttachmentType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PostAttachment entity.
     *
     * @Route("/{id}", name="attachments_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostAttachment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostAttachment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PostAttachment entity.
     *
     * @Route("/{id}/edit", name="attachments_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostAttachment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostAttachment entity.');
        }

        $editForm = $this->createForm(new PostAttachmentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing PostAttachment entity.
     *
     * @Route("/{id}", name="attachments_update")
     * @Method("PUT")
     * @Template("CMSStoreBundle:PostAttachment:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostAttachment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostAttachment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PostAttachmentType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('attachments_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a PostAttachment entity.
     *
     * @Route("/{id}", name="attachments_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSStoreBundle:PostAttachment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PostAttachment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('attachments'));
    }

    /**
     * Creates a form to delete a PostAttachment entity by id.
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
