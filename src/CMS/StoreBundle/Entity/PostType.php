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
    public static $page_type_id = 1;

    public static $post_type_id = 2;

    public static $news_type_id = 3;

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

    public static function retriveId($name)
    {
        switch ($name)
        {
            case 'news':
                $_r = self::$news_type_id;
                break;
            case 'page':
                $_r = self::$page_type_id;
                break;
            case 'post':
                $_r = self::$post_type_id;
                break;
        }

        return $_r;
    }

}