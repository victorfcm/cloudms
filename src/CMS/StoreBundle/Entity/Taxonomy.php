<?php

namespace CMS\StoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Taxonomy
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Taxonomy
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @var \CMS\StoreBundle\Entity\Term
     *
     * @ORM\OneToMany(targetEntity="Term", mappedBy="taxonomy", cascade="persist")
     */
    private $terms;
    
    /**
     * @var \CMS\StoreBundle\Entity\PostType
     *
     * @ORM\ManyToOne(targetEntity="PostType", inversedBy="taxonomy", cascade="persist")
     */
    private $postTypes;

	/** 
     * @var string
     * 
     * @ORM\Column(name="slug", type="string", length=128, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * toString
     *  
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->terms = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Taxonomy
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Taxonomy
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Taxonomy
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add terms
     *
     * @param \CMS\StoreBundle\Entity\Term $terms
     * @return Taxonomy
     */
    public function addTerm(\CMS\StoreBundle\Entity\Term $terms)
    {
        $this->terms[] = $terms;

        return $this;
    }

    /**
     * Remove terms
     *
     * @param \CMS\StoreBundle\Entity\Term $terms
     */
    public function removeTerm(\CMS\StoreBundle\Entity\Term $terms)
    {
        $this->terms->removeElement($terms);
    }

    /**
     * Get terms
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * Set postTypes
     *
     * @param \CMS\StoreBundle\Entity\PostType $postTypes
     * @return Taxonomy
     */
    public function setPostTypes(\CMS\StoreBundle\Entity\PostType $postTypes = null)
    {
        $this->postTypes = $postTypes;

        return $this;
    }

    /**
     * Get postTypes
     *
     * @return \CMS\StoreBundle\Entity\PostType 
     */
    public function getPostTypes()
    {
        return $this->postTypes;
    }
}
