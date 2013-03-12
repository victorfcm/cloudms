<?php

namespace CMS\StoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Entity\PostTermRelashionship;
use CMS\StoreBundle\Form\PostTermRelashionshipType;

/**
 * PostTermRelashionship controller.
 *
 * @Route("/post-term")
 */
class PostTermRelashionshipController extends Controller
{
    /**
     * Lists all PostTermRelashionship entities.
     *
     * @Route("/", name="posttermrelashionship")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CMSStoreBundle:PostTermRelashionship')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new PostTermRelashionship entity.
     *
     * @Route("/", name="posttermrelashionship_create")
     * @Method("POST")
     * @Template("CMSStoreBundle:PostTermRelashionship:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new PostTermRelashionship();
        $form = $this->createForm(new PostTermRelashionshipType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('posttermrelashionship_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new PostTermRelashionship entity.
     *
     * @Route("/new", name="posttermrelashionship_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new PostTermRelashionship();
        $form   = $this->createForm(new PostTermRelashionshipType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PostTermRelashionship entity.
     *
     * @Route("/{id}", name="posttermrelashionship_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostTermRelashionship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostTermRelashionship entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing PostTermRelashionship entity.
     *
     * @Route("/{id}/edit", name="posttermrelashionship_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostTermRelashionship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostTermRelashionship entity.');
        }

        $editForm = $this->createForm(new PostTermRelashionshipType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing PostTermRelashionship entity.
     *
     * @Route("/{id}", name="posttermrelashionship_update")
     * @Method("PUT")
     * @Template("CMSStoreBundle:PostTermRelashionship:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:PostTermRelashionship')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PostTermRelashionship entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new PostTermRelashionshipType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('posttermrelashionship_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a PostTermRelashionship entity.
     *
     * @Route("/{id}", name="posttermrelashionship_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CMSStoreBundle:PostTermRelashionship')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PostTermRelashionship entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('posttermrelashionship'));
    }

    /**
     * Creates a form to delete a PostTermRelashionship entity by id.
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
