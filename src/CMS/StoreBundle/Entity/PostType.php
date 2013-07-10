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
     * @var \CMS\StoreBundle\Entity\Taxonomy
     *
     * @ORM\OneToMany(targetEntity="Taxonomy", mappedBy="postTypes")
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
     * toString
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
    
    public function setInMenu($in_menu)
    {
        $this->inMenu = $in_menu;
    }
    
    public function isInMenu()
    {
        return (true === $this->inMenu)? true : false;
    }
    
    public function getBySlug($slug)
    {
        if($this->name === strtolower($slug))
            return $this->id;
        
        return false;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->taxonomys = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
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
}
