<?php

namespace CMS\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TermType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array('label' => 'Nome'))
            ->add('description', 'textarea', array('label' => 'Descrição'))
            ->add('taxonomys', 'entity', array('class' => 'CMSStoreBundle:Taxonomy', 'multiple' => false))
            ->add('slug')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\StoreBundle\Entity\Term'
        ));
    }

    public function getName()
    {
        return 'cms_storebundle_termtype';
    }
}
