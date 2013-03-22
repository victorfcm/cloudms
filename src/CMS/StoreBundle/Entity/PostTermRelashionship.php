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
     * @ORM\ManyToOne(targetEntity="Term", inversedBy="posts")
     */
    private $term;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="terms")
     */
    private $post;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getTerm()
    {
        return $this->term;
    }
    
    public function getPost()
    {
        return $this->post;
    }
    
    public function setTerm($term)
    {
        $this->term = $term;
    }
    
    public function setPost($post)
    {
        $this->post = $post;
    }
}