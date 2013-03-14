<?php

namespace CMS\StoreBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\RadioType;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as ProfileType;

class UserType extends ProfileType
{
    public function __construct()
    {
        $class = 'User';
        parent::__construct($class);        
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')->add('roles');
        
        parent::buildForm($builder, $options);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CMS\StoreBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'cms_storebundle_usertype';
    }
}
