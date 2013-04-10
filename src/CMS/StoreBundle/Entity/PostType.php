<?php

namespace CMS\StoreBundle\Entity;

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
     * @ORM\Column(name="in_menu", type="boolean", options={"default":true})
     */
    private $inMenu;
    
    /**
     * @var \CMS\StoreBundle\Entity\PostTypeTaxonomyRelashionship
     *
     * @ORM\OneToMany(targetEntity="PostTypeTaxonomyRelashionship", mappedBy="postType")
     */
    private $taxonomys;
    
    public function getTaxonomys()
    {
        return $this->taxonomys;
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
     * toString
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
    
    public function getPosts()
    {
        return $this->posts;
    }
    
    public function setPosts($posts)
    {
        $this->posts = $posts;
    }
    
    public function setTaxonomys($taxonomys)
    {
        $this->taxonomys = $taxonomys;
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

}