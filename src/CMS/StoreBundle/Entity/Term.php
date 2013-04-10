<?php

namespace CMS\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Term
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Term
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
     * @var \CMS\StoreBundle\Entity\Taxonomy
     *
     * @ORM\OneToMany(targetEntity="TermTaxonomyRelashionship", mappedBy="term", cascade="remove")
     */
    private $taxonomys;

    /**
     * @var \CMS\StoreBundle\Entity\Term
     *
     * @ORM\ManyToOne(targetEntity="Term")
     * @ORM\JoinColumn(name="daddy_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $daddyId;
    
    /**
     * @var \CMS\StoreBundle\Entity\Post
     *
     * @ORM\OneToMany(targetEntity="PostTermRelashionship", mappedBy="term", cascade="remove")
     */
    private $posts;


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
     * @return Term
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
     * @return Term
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
     * Set taxonomyId
     *
     * @param integer $taxonomyId
     * @return Term
     */
    public function setTaxonomyId($taxonomyId)
    {
        $this->taxonomyId = $taxonomyId;
    
        return $this;
    }

    /**
     * Get taxonomyId
     *
     * @return integer 
     */
    public function getTaxonomys()
    {
        return $this->taxonomys;
    }

    /**
     * Set daddyId
     *
     * @param integer $daddyId
     * @return Term
     */
    public function setDaddyId($daddyId)
    {
        $this->daddyId = $daddyId;
    
        return $this;
    }

    /**
     * Get daddyId
     *
     * @return integer 
     */
    public function getDaddyId()
    {
        return $this->daddyId;
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
    
    /*
     * set taxonomys
     * 
     * @param collection $taxonomys
     */
    public function setTaxonomys($taxonomys)
    {
        $this->taxonomys = $taxonomys;
    }
}