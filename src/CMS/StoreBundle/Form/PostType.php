<?php

namespace CMS\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text', array('label' => 'Título'))
            ->add('content', 'textarea', array('label' => 'Conteúdo'))
            ->add('postType')
            ->add('userId')
            ->add('children')
            ->add('daddy')
            ->add('slug', 'text', array('label' => 'Endereço URL'))
            ->add('position', 'integer', array('label' => 'Posição'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\StoreBundle\Entity\Post'
        ));
    }

    public function getName()
    {
        return 'cms_storebundle_posttype';
    }
}
