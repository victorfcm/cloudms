<?php

namespace CMS\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Entity\PostType;
use CMS\StoreBundle\Form\PostTypeType;

/**
 * PostType controller.
 *
 * @Route("/post_type")
 */
class PostTypeController extends Controller
{
    /**
     * Lists all PostType entities.
     *
     * @Route("/", name="post_type")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSStoreBundle:PostType')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new PostType entity.
     *
     * @Route("/", name="post_type_create")
     * @Method("POST")
     * @Template("CMSStoreBundle:PostType:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new PostType();
        $form = $this->createForm(new PostTypeType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_type_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new PostType entity.
     *
     * @Route("/new", name="post_type_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PostType();
        $form   = $this->createForm(new PostTypeType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PostType entity.
     *
     * @Route("/{id}", name="post_type_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PostType entity.
     *
     * @Route("/{id}/edit", name="post_type_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostType entity.');
        }

        $editForm = $this->createForm(new PostTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing PostType entity.
     *
     * @Route("/{id}", name="post_type_update")
     * @Method("PUT")
     * @Template("CMSStoreBundle:PostType:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostType')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostType entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PostTypeType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_type_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a PostType entity.
     *
     * @Route("/{id}", name="post_type_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSStoreBundle:PostType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PostType entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('post_type'));
    }

    /**
     * Creates a form to delete a PostType entity by id.
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
