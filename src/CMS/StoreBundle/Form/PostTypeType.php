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
            ->add('taxonomys', 'entity', array('class' => 'CMS\StoreBundle\Entity\Taxonomy', 'multiple' => true, 'required' => false))
            ->add('inMenu', 'checkbox', array('required' => false));
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
