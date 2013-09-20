<?php

namespace CMS\StoreBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
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
     * @ORM\OneToMany(targetEntity="PostAttachment", mappedBy="post", cascade={"all"})
     */
    private $attachments;

    /**
     * @var \CMS\StoreBundle\Entity\PostType
     * 
     * @ORM\ManyToOne(targetEntity="PostType", inversedBy="posts")
     * @ORM\JoinColumn(name="post_type_id", referencedColumnName="id", onDelete="SET NULL")
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
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $userId;
    
    /**
     * @var \CMS\StoreBundle\Entity\Post
     * 
     * @ORM\OneToMany(targetEntity="Post", mappedBy="daddy", cascade={"persist","remove"})
     */
    private $children;

    /**
     * @var \CMS\StoreBundle\Entity\Term
     *
     * @ORM\ManyToMany(targetEntity="Term", mappedBy="posts", cascade="persist")
     */
    private $terms;
    
    /**
     * @var \CMS\StoreBundle\Entity\Post
     *
     * @ORM\ManyToOne(targetEntity="Post" , inversedBy="children")
     */
    private $daddy;

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
     * @var string
     * 
     * @ORM\Column(name="slug", type="string", length=128, unique=true)
     * @Gedmo\Slug(fields={"title"})
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
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attachments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->terms = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add attachments
     *
     * @param \CMS\StoreBundle\Entity\PostAttachment $attachments
     * @return Post
     */
    public function addAttachment(\CMS\StoreBundle\Entity\PostAttachment $attachments)
    {
        $this->attachments[] = $attachments;
    
        return $this;
    }

    /**
     * Remove attachments
     *
     * @param \CMS\StoreBundle\Entity\PostAttachment $attachments
     */
    public function removeAttachment(\CMS\StoreBundle\Entity\PostAttachment $attachments)
    {
        $this->attachments->removeElement($attachments);
    }

    /**
     * Get attachments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Add terms
     *
     * @param \CMS\StoreBundle\Entity\Term $terms
     * @return Post
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
	
	public function removeAllTerms()
	{
		foreach($this->getTerms() as $_t)
		{
			$_t->removePost($this);
		}
		
		$this->getTerms()->clear();
	}
    
    public function hasTerm($term)
    {
		foreach($this->getTerms() as $_t)
		{
			if($term->getId() === $_t->getId())
				return true;
		}
		
		return false;
	}

    /**
     * Add children
     *
     * @param \CMS\StoreBundle\Entity\Post $children
     * @return Post
     */
    public function addChildren(\CMS\StoreBundle\Entity\Post $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \CMS\StoreBundle\Entity\Post $children
     */
    public function removeChildren(\CMS\StoreBundle\Entity\Post $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Set postType
     *
     * @param \CMS\StoreBundle\Entity\PostType $postType
     * @return Post
     */
    public function setPostType(\CMS\StoreBundle\Entity\PostType $postType = null)
    {
        $this->postType = $postType;
    
        return $this;
    }

    /**
     * Get postType
     *
     * @return \CMS\StoreBundle\Entity\PostType 
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
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
     * Set daddy
     *
     * @param \CMS\StoreBundle\Entity\Post $daddy
     * @return Post
     */
    public function setDaddy(\CMS\StoreBundle\Entity\Post $daddy = null)
    {
        $this->daddy = $daddy;
    
        return $this;
    }

    /**
     * Get daddy
     *
     * @return \CMS\StoreBundle\Entity\Post 
     */
    public function getDaddy()
    {
        return $this->daddy;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Post
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
     * Add children
     *
     * @param \CMS\StoreBundle\Entity\Post $children
     * @return Post
     */
    public function addChild(\CMS\StoreBundle\Entity\Post $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \CMS\StoreBundle\Entity\Post $children
     */
    public function removeChild(\CMS\StoreBundle\Entity\Post $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Post
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
    
    public function getTermsChoice()
    {
		return $this->getPostType()->getTaxonomy()->getTerms();
	}
	
    public function getTaxonomyName()
    {
		return $this->getPostType()->getTaxonomy()->getName();
	}
	
	public function getFirstAttachment()
	{
		foreach($this->getAttachments() as $at)
		{
			return $at;
		}
		
		return null;
	}
}
