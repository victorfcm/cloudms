<?php

namespace CMS\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use CMS\StoreBundle\Entity\Taxonomy;
use CMS\StoreBundle\Entity\Term;

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
     * @ORM\ManyToOne(targetEntity="Term", inversedBy="taxonomys", cascade="persist")
     */
    private $term;

    /**
     * @ORM\ManyToOne(targetEntity="Taxonomy", inversedBy="terms", cascade="persist")
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
     * Get Taxonomy 
     * 
     * @return collection
     */
    public function getTaxonomy()
    {
        return $this->taxonomy;
    }
    
    /**
     * Get Term
     * 
     * @return collection
     */
    public function getTerm()
    {
        return $this->term;
    }
    
    /**
     * Get Terms
     * 
     * @return collection 
     */
    public function getTerms()
    {
        return $this->terms;
    }
    
    /**
     * Set Taxonomy
     * 
     * @return null
     */
    public function setTaxonomy(Taxonomy $taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }
    
    /**
     * Set Term
     * 
     * @return null
     */
    public function setTerm(Term $term)
    {
        $this->term = $term;
    }
    
}
