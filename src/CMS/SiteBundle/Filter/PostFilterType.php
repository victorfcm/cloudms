<?php

namespace CMS\SiteBundle\Filter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\QueryBuilder;
use Lexik\Bundle\FormFilterBundle\Filter\ORM\Expr;

class PostFilterType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('terms', 'filter_entity', array(
                'class' => 'CMSStoreBundle:Term',
                'apply_filter' => function (QueryBuilder $queryBuilder, Expr $expr, $field, array $values)
                {
                    if (!empty($values['value']))
                    {
                        $entity = $values['value'];
                        
                        $queryBuilder
                        ->leftJoin($values['alias'].".terms", 't')
                        ->andWhere('t.term = :taxonomyId')
                        ->setParameter('taxonomyId', $entity->getId());
                    }
                },
                'label' => false
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }

    public function getName()
    {
        return 'cms_storebundle_termfilter';
    }

}
