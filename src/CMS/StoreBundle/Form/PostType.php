<?php

namespace CMS\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Doctrine\ORM\EntityRepository;
use CMS\StoreBundle\Entity\Taxonomy;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', new Types\TextType())
            ->add('content')
            ->add('postTypeId')
            ->add('userId')
            ->add('daddyId');
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
