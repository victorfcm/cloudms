<?php

namespace CMS\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostType
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PostRelashionship
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
     * @var integer
     *
     * @ORM\Column(name="daddy_id", type="integer")
     */
    private $daddyId;


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
     * @return PostType
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
     * Set daddyId
     *
     * @param integer $daddyId
     * @return PostType
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
}
