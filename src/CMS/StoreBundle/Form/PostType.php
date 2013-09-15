<?php

namespace CMS\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
	private $formOptions;
    
    public function __construct($options = array())
    {        
        $this->formOptions = $options;
    }
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$searchTool = (!empty($this->formOptions)) ? (isset($this->formOptions["em"])) ? $this->formOptions["em"] : $this->formOptions["postType"] : null;
		
        $builder
            ->add('title', 'text', array('label' => 'Título'))
            ->add('content', 'textarea', array('label' => 'Conteúdo'))
            ->add('postType')
            ->add('userId')
            ->add('children')
            ->add('daddy')
            ->add('slug', 'text', array('label' => 'Endereço URL'))
            ->add('position', 'integer', array('label' => 'Posição'));
            
         if(null !== $searchTool)
         {
            $builder->add("terms", "entity", array("required" => true,
                      "class" => 'CMSStoreBundle:Term',
                      "choices" => $searchTool->getTermsChoice(),
                      'multiple' => true,
                      'label' => $searchTool->getTaxonomyName()
			));
		}
		else
		{
			$builder->add("terms");
		}
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
