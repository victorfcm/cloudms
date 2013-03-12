<?php

namespace CMS\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Entity\PostRelashionship;
use CMS\StoreBundle\Form\PostRelashionshipType;

/**
 * PostRelashionship controller.
 *
 * @Route("/post_relashionship")
 */
class PostRelashionshipController extends Controller
{
    /**
     * Lists all PostRelashionship entities.
     *
     * @Route("/", name="post_relashionship")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSStoreBundle:PostRelashionship')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new PostRelashionship entity.
     *
     * @Route("/", name="post_relashionship_create")
     * @Method("POST")
     * @Template("CMSStoreBundle:PostRelashionship:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new PostRelashionship();
        $form = $this->createForm(new PostRelashionshipType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_relashionship_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new PostRelashionship entity.
     *
     * @Route("/new", name="post_relashionship_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PostRelashionship();
        $form   = $this->createForm(new PostRelashionshipType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PostRelashionship entity.
     *
     * @Route("/{id}", name="post_relashionship_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostRelashionship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostRelashionship entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PostRelashionship entity.
     *
     * @Route("/{id}/edit", name="post_relashionship_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostRelashionship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostRelashionship entity.');
        }

        $editForm = $this->createForm(new PostRelashionshipType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing PostRelashionship entity.
     *
     * @Route("/{id}", name="post_relashionship_update")
     * @Method("PUT")
     * @Template("CMSStoreBundle:PostRelashionship:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostRelashionship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostRelashionship entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PostRelashionshipType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('post_relashionship_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a PostRelashionship entity.
     *
     * @Route("/{id}", name="post_relashionship_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSStoreBundle:PostRelashionship')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PostRelashionship entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('post_relashionship'));
    }

    /**
     * Creates a form to delete a PostRelashionship entity by id.
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
