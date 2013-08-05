<?php

namespace CMS\StoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * PostType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PostType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")/**
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @var \CMS\StoreBundle\Entity\Post
     * 
     * @ORM\OneToMany(targetEntity="Post", mappedBy="postType")
     */
    private $posts;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(name="in_menu", type="boolean", options={"default":false}, nullable=true)
     */
    private $inMenu;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(name="editable", type="boolean", options={"default":true}, nullable=false)
     */
    private $editable;
    
    /**
     * @var \CMS\StoreBundle\Entity\Taxonomy
     *
     * @ORM\OneToMany(targetEntity="Taxonomy", mappedBy="postTypes", cascade="persist")
     */
    private $taxonomys;
    
    /** 
     * @var string
     * 
     * @ORM\Column(name="slug", type="string", length=128, unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="position", type="integer")
     * @Gedmo\SortablePosition
     */
    private $position;

    /**
     * toString
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
    
    public function isInMenu()
    {
        return (true === $this->inMenu)? true : false;
    }
    
    public function isEditable()
    {
        return (true === $this->editable)? true : false;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        #$this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        #$this->taxonomys = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return PostType
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
     * @return PostType
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
     * Set inMenu
     *
     * @param boolean $inMenu
     * @return PostType
     */
    public function setInMenu($inMenu)
    {
        $this->inMenu = $inMenu;

        return $this;
    }

    /**
     * Get inMenu
     *
     * @return boolean 
     */
    public function getInMenu()
    {
        return $this->inMenu;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return PostType
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
     * Set position
     *
     * @param integer $position
     * @return PostType
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add posts
     *
     * @param \CMS\StoreBundle\Entity\Post $posts
     * @return PostType
     */
    public function addPost(\CMS\StoreBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \CMS\StoreBundle\Entity\Post $posts
     */
    public function removePost(\CMS\StoreBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add taxonomys
     *
     * @param \CMS\StoreBundle\Entity\Taxonomy $taxonomys
     * @return PostType
     */
    public function addTaxonomy(\CMS\StoreBundle\Entity\Taxonomy $taxonomys)
    {
        $this->taxonomys[] = $taxonomys;

        return $this;
    }

    /**
     * Remove taxonomys
     *
     * @param \CMS\StoreBundle\Entity\Taxonomy $taxonomys
     */
    public function removeTaxonomy(\CMS\StoreBundle\Entity\Taxonomy $taxonomys)
    {
        $this->taxonomys->removeElement($taxonomys);
    }

    /**
     * Get taxonomys
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTaxonomys()
    {
        return $this->taxonomys;
    }

    /**
     * Set editable
     *
     * @param boolean $editable
     * @return PostType
     */
    public function setEditable($editable)
    {
        $this->editable = $editable;

        return $this;
    }

    /**
     * Get editable
     *
     * @return boolean 
     */
    public function getEditable()
    {
        return $this->editable;
    }
}
