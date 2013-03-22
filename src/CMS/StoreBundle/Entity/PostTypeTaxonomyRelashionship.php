<?php

namespace CMS\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PostTypeTaxonomyRelashionship
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PostTypeTaxonomyRelashionship
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
     * @ORM\ManyToOne(targetEntity="PostType", inversedBy="taxonomys")
     */
    private $postType;

    /**
     * @ORM\ManyToOne(targetEntity="Taxonomy", inversedBy="postTypes")
     */
    private $taxonomy;


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
     * Set postType
     *
     * @param integer $postType
     * @return PostTypeTaxonomyRelashionship
     */
    public function setPostType($postType)
    {
        $this->postType = $postType;
    
        return $this;
    }

    /**
     * Get postType
     *
     * @return integer 
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * Set taxonomy
     *
     * @param integer $taxonomy
     * @return PostTypeTaxonomyRelashionship
     */
    public function setTaxonomy($taxonomy)
    {
        $this->taxonomy = $taxonomy;
    
        return $this;
    }

    /**
     * Get taxonomy
     *
     * @return integer 
     */
    public function getTaxonomy()
    {
        return $this->taxonomy;
    }
}