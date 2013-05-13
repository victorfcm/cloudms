<?php

namespace CMS\StoreBundle\Entity;

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
     * @ORM\OneToMany(targetEntity="PostType", mappedBy="taxonomys", cascade="persist")
     */
    private $postTypes;


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
        $this->postTypes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add postTypes
     *
     * @param \CMS\StoreBundle\Entity\PostType $postTypes
     * @return Taxonomy
     */
    public function addPostType(\CMS\StoreBundle\Entity\PostType $postTypes)
    {
        $this->postTypes[] = $postTypes;
    
        return $this;
    }

    /**
     * Remove postTypes
     *
     * @param \CMS\StoreBundle\Entity\PostType $postTypes
     */
    public function removePostType(\CMS\StoreBundle\Entity\PostType $postTypes)
    {
        $this->postTypes->removeElement($postTypes);
    }

    /**
     * Get postTypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPostTypes()
    {
        return $this->postTypes;
    }
}