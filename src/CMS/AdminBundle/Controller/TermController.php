<?php

namespace CMS\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use CMS\StoreBundle\Controller\TermController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CMS\StoreBundle\Entity\Term;
use CMS\StoreBundle\Form\TermType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType as HiddenType;
use CMS\StoreBundle\Filter\TermFilterType;

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
     * @Route("/list/{taxId}", name="term_clist")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function listAction($taxId)
    {
        $entities = array();
        $em = $this->getDoctrine()->getManager();

        $taxonomy = $em->getRepository('CMSStoreBundle:Taxonomy')->findOneBySlug($taxId);
        $filterBuilder = $em->getRepository('CMSStoreBundle:Term')->findByTaxonomy($taxonomy->getId());

        $form_filter = $this->get('form.factory')->create(new TermFilterType());

        if ($this->get('request')->request->has('submit-filter'))
        {
            // bind values from the request
            $form_filter->bind($this->get('request'));

            // initliaze a query builder
            $filterBuilder = $em->getRepository('CMSStoreBundle:Term')
                ->createQueryBuilder('t');

            // build the query from the given form object
            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form_filter, $filterBuilder);
        }

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $filterBuilder, $this->get('request')->query->get('page', 1), 5
        );

        return array(
            'entities' => $pagination,
            'taxonomy' => $taxonomy,
            'pagination' => $pagination,
            'form_filter' => $form_filter->createView()
        );
    }

    /**
     * Creates a new Term entity.
     *
     * @Route("/", name="term_ccreate")
     * @Method("POST")
     * @Template("CMSAdminBundle:Term:new.html.twig")
     */
    public function createAction(Request $request, $redirUrl = 'term_clist')
    {
        return parent::createAction($request, $redirUrl);
    }

    /**
     * Displays a form to create a new Term entity.
     *
     * @Route("/{taxId}/new", name="term_cnew")
     * @Method("GET")
     * @Template()
     */
    public function newAction($taxId = null)
    {
        $ar = parent::newAction();
        $form = $ar['default_form'];

        $taxonomy = $this->getDoctrine()->getManager()->getRepository('CMSStoreBundle:Taxonomy')->findOneBySlug($taxId);
        $ar['taxonomy'] = $taxonomy->getSlug();

        if (null !== $taxId)
        {
            $form->remove('taxonomy');
            $form->add('taxonomy', new HiddenType(), array('attr' => array('value' => $taxonomy->getId())));
        }

        $ar['form'] = $form->createView();

        return $ar;
    }

    /**
     * Finds and displays a Term entity.
     *
     * @Route("/{id}", name="term_cshow")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:Term')->find($id);

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Term entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Term entity.
     *
     * @Route("/{id}/edit", name="term_cedit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSStoreBundle:Term')->findOneBySlug($id);

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Term entity.');
        }
        
        $taxonomy = $entity->getTaxonomy();
        
        $editForm = $this->createForm(new TermType(), $entity);
        $editForm->remove('taxonomy');
        $editForm->add('taxonomy', 'entity', array('class' => 'CMS\StoreBundle\Entity\Taxonomy',
            'attr' => array('style' => 'display:none'),
            'label_attr' => array('style' => 'display:none')
        ));
        
        $deleteForm = $this->createDeleteForm($entity->getId());

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'taxonomy' => $taxonomy->getName()
        );
    }

    /**
     * Edits an existing Term entity.
     *
     * @Route("/{id}", name="term_cupdate")
     * @Method("PUT")
     * @Template("CMSAdminBundle:Term:edit.html.twig")
     */
    public function updateAction(Request $request, $id, $redirUrl = 'term_cedit')
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CMSStoreBundle:Term')->findOneBySlug($id);

        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Term entity.');
        }

        $deleteForm = $this->createDeleteForm($entity->getId());
        $editForm = $this->createForm(new TermType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid())
        {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->setFlash(
                'notice', 'Alteração salva com sucesso!'
            );

            return $this->redirect($this->generateUrl($redirUrl, array('id' => $entity->getSlug())));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Term entity.
     *
     * @Route("/delete/{id}", name="term_cdelete")
     * @Method({"DELETE", "GET"})
     */
    public function deleteAction(Request $request, $id, $redirUrl = 'term_clist')
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('CMSStoreBundle:Term')->findOneBySlug($id);
        
        if (!$entity)
        {
            throw $this->createNotFoundException('Unable to find Term entity.');
        }
        
        $taxonomy = $entity->getTaxonomys();

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl($redirUrl, array('taxId' => $taxonomy[0]->getTaxonomy()->getSlug())));
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
