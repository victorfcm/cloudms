<?php

namespace CMS\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostAttachment
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PostAttachment
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
     * @var integer
     * 
     * @ORM\Column(name="post_id", type="integer")
     */
    private $postId;
    
    /**
     * @var \CMS\StoreBundle\Entity\Post
     * 
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="attachments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id") 
     */
    private $posts;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=100)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="mime", type="string", length=30)
     */
    private $mime;


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
     * Set postId
     *
     * @param integer $postId
     * @return PostAttachment
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    
        return $this;
    }

    /**
     * Get postId
     *
     * @return integer 
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return PostAttachment
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     * @return PostAttachment
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    
        return $this;
    }

    /**
     * Get fileName
     *
     * @return string 
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set mime
     *
     * @param string $mime
     * @return PostAttachment
     */
    public function setMime($mime)
    {
        $this->mime = $mime;
    
        return $this;
    }

    /**
     * Get mime
     *
     * @return string 
     */
    public function getMime()
    {
        return $this->mime;
    }
    
    /**
     * toString
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getFileName();
    }

    /**
     * Set posts
     *
     * @param \CMS\StoreBundle\Entity\Post $posts
     * @return PostAttachment
     */
    public function setPosts(\CMS\StoreBundle\Entity\Post $posts = null)
    {
        $this->posts = $posts;
    
        return $this;
    }

    /**
     * Get posts
     *
     * @return \CMS\StoreBundle\Entity\Post 
     */
    public function getPosts()
    {
        return $this->posts;
    }
}