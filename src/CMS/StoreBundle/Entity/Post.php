<?php

namespace CMS\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Post
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
     * @ORM\Column(name="header", type="text", nullable=true)
     */
    private $header;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="footer", type="text", nullable=true)
     */
    private $footer;
    
    /**
     * @var \CMS\StoreBundle\Entity\PostAttachment
     * 
     * @ORM\OneToMany(targetEntity="PostAttachment", mappedBy="posts", cascade={"all"})
     */
    private $attachments;

    /**
     * @var \CMS\StoreBundle\Entity\PostType
     * 
     * @ORM\ManyToOne(targetEntity="PostType", inversedBy="posts")
     * @ORM\JoinColumn(name="post_type_id", referencedColumnName="id")
     */
    private $postType;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="postTypeId", type="integer", nullable=true)
     */
    private $postTypeId;

    /**
     * @var integer
     * 
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;
    
    /**
     * @var \CMS\StoreBundle\Entity\Post
     * 
     * @ORM\ManyToOne(targetEntity="Post", cascade={"all"})
     * @ORM\JoinColumn(name="daddy_id", referencedColumnName="id")
     */
    private $children;

    /**
     * @var \CMS\StoreBundle\Entity\Term
     *
     * @ORM\OneToMany(targetEntity="PostTermRelashionship", mappedBy="post")
     */
    private $terms;
    
    /**
     * @var integer
     * 
     * @ORM\Column(name="daddy_id", type="integer", nullable=true)
     */
    private $daddyId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

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
     * Set header
     *
     * @param string $header
     * @return Post
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get header
     *
     * @return string 
     */
    public function getHeader()
    {
        return $this->header;
    }
    
    /**
     * Set title
     *
     * @param string $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set footer
     *
     * @param string $footer
     * @return Post
     */
    public function setFooter($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * Get footer
     *
     * @return string 
     */
    public function getFooter()
    {
        return $this->footer;
    }

    /**
     * Set postTypeId
     *
     * @param integer $postTypeId
     * @return Post
     */
    public function setPostTypeId($postTypeId)
    {
        $this->postTypeId = $postTypeId;

        return $this;
    }

    /**
     * Get postTypeId
     *
     * @return integer 
     */
    public function getPostTypeId()
    {
        return $this->postTypeId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Post
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Post
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set daddyId
     *
     * @param string $daddyId
     * @return Post
     */
    public function setDaddyId($daddyId)
    {
        $this->daddyId = $daddyId;

        return $this;
    }

    /**
     * Get daddyId
     *
     * @return string
     */
    public function getDaddyId()
    {
        return $this->daddyId;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime(date('Y-m-d H:i:s')));

        if($this->getCreatedAt() == null)
        {
            $this->setCreatedAt(new \DateTime(date('Y-m-d H:i:s')));
        }
    }
    
    /**
     * toString
     * 
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
    
    public function getChildren()
    {
        return $this->children;
    }
    
    public function getPostType()
    {
        return $this->postType;
    }
    
    public function setChildren($child)
    {
        $this->children = $child;
    }
    
    public function setPostType($type)
    {
        $this->postType = $type;
    }
}