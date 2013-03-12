<?php

namespace CMS\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostAttachmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('postId')
            ->add('path')
            ->add('fileName')
            ->add('mime')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\StoreBundle\Entity\PostAttachment'
        ));
    }

    public function getName()
    {
        return 'cms_storebundle_postattachmenttype';
    }
}
