<?php

namespace CMS\StoreBundle\Filter;

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
            ->add('title', 'filter_text', array(
                'apply_filter' => function (QueryBuilder $queryBuilder, Expr $expr, $field, array $values)
                {
                    if (!empty($values['value']))
                    {
                        $queryBuilder->andWhere($values['alias'].".title LIKE :title")
                        ->setParameter('title', '%'.$values['value'].'%');
                    }
                },
                'label' => 'Título'
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
