<?php

namespace CMS\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Entity\UserPermission;
use CMS\StoreBundle\Form\UserPermissionType;

/**
 * UserPermission controller.
 *
 * @Route("/user_role")
 */
class UserPermissionController extends Controller
{
    /**
     * Lists all UserPermission entities.
     *
     * @Route("/", name="user_role")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSStoreBundle:UserPermission')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new UserPermission entity.
     *
     * @Route("/", name="user_role_create")
     * @Method("POST")
     * @Template("CMSStoreBundle:UserPermission:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new UserPermission();
        $form = $this->createForm(new UserPermissionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_role_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new UserPermission entity.
     *
     * @Route("/new", name="user_role_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new UserPermission();
        $form   = $this->createForm(new UserPermissionType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a UserPermission entity.
     *
     * @Route("/{id}", name="user_role_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:UserPermission')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserPermission entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing UserPermission entity.
     *
     * @Route("/{id}/edit", name="user_role_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:UserPermission')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserPermission entity.');
        }

        $editForm = $this->createForm(new UserPermissionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing UserPermission entity.
     *
     * @Route("/{id}", name="user_role_update")
     * @Method("PUT")
     * @Template("CMSStoreBundle:UserPermission:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:UserPermission')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UserPermission entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new UserPermissionType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_role_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a UserPermission entity.
     *
     * @Route("/{id}", name="user_role_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSStoreBundle:UserPermission')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UserPermission entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user_role'));
    }

    /**
     * Creates a form to delete a UserPermission entity by id.
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
