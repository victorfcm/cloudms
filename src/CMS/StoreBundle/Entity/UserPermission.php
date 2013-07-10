<?php

namespace CMS\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserPermission
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class UserPermission
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
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="permissions", type="object")
     */
    private $permissions;


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
     * Set userId
     *
     * @param integer $userId
     * @return UserPermission
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
     * Set permissions
     *
     * @param \stdClass $permissions
     * @return UserPermission
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    
        return $this;
    }

    /**
     * Get permissions
     *
     * @return \stdClass 
     */
    public function getPermissions()
    {
        return $this->permissions;
    }
}
