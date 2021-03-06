<?php

namespace CMS\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostTypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('taxonomy', 'entity', array('class' => 'CMSStoreBundle:Taxonomy', 'multiple' => false))
            ->add('inMenu', 'checkbox', array('required' => false))
            ->add('slug', 'text', array('label' => 'Endereço URL'))
            ->add('position', 'integer', array('label' => 'Posição'))
            ->add('editable')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\StoreBundle\Entity\PostType'
        ));
    }

    public function getName()
    {
        return 'cms_storebundle_posttypetype';
    }
}
