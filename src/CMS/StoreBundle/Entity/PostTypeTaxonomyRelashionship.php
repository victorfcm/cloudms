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
     * Set postTypeId
     *
     * @param integer $postTypeId
     * @return PostTypeTaxonomyRelashionship
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
     * Set taxonomyId
     *
     * @param integer $taxonomyId
     * @return PostTypeTaxonomyRelashionship
     */
    public function setTaxonomyId($taxonomyId)
    {
        $this->taxonomyId = $taxonomyId;
    
        return $this;
    }

    /**
     * Get taxonomyId
     *
     * @return integer 
     */
    public function getTaxonomyId()
    {
        return $this->taxonomyId;
    }
}