<?php

namespace CMS\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostTermRelashionship
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PostTermRelashionship
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
     * @ORM\OneToOne(targetEntity="Term")
     * @ORM\JoinColumn(name="term_id", referencedColumnName="id")
     */
    private $termId;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="Post")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     */
    private $postId;


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
     * Set termId
     *
     * @param integer $termId
     * @return PostTermRelashionship
     */
    public function setTermId($termId)
    {
        $this->termId = $termId;
    
        return $this;
    }

    /**
     * Get termId
     *
     * @return integer 
     */
    public function getTermId()
    {
        return $this->termId;
    }

    /**
     * Set postId
     *
     * @param integer $postId
     * @return PostTermRelashionship
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
}