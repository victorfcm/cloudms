<?php

namespace CMS\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TermTaxonomyRelashionship
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TermTaxonomyRelashionship
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
     * @ORM\ManyToOne(targetEntity="Term")
     * @ORM\JoinColumn(name="term_id", referencedColumnName="id")
     */
    private $termId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="taxonomy")
     * @ORM\JoinColumn(name="taxonomy_id", referencedColumnName="id")
     */
    private $taxonomyId;


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
     * @return TermTaxonomyRelashionship
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
     * Set taxonomyId
     *
     * @param integer $taxonomyId
     * @return TermTaxonomyRelashionship
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
