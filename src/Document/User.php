<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 13/03/18
 * Time: 10:43
 */

namespace App\Document;

use DoL\LdapBundle\Model\LdapUserInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class User extends BaseUser implements LdapUserInterface
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $FullName;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $signature;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $lastName;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $male;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $female;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $image;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $dn;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * Get lastName
     *
     * @return string $lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * Set Ldap Distinguished Name.
     *
     * @param string $dn Distinguished Name
     */
    public function setDn($dn)
    {
        $this->dn = $dn;
    }

    /**
     * Get Ldap Distinguished Name.
     *
     * @return string Distinguished Name
     */
    public function getDn()
    {
        return $this->dn;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->FullName;
    }

    /**
     * @param mixed $FullName
     */
    public function setFullName($FullName): void
    {
        $this->FullName = $FullName;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param mixed $signature
     */
    public function setSignature($signature): void
    {
        $this->signature = $signature;
    }

    /**
     * @return mixed
     */
    public function getMale()
    {
        return $this->male;
    }

    /**
     * @param mixed $male
     */
    public function setMale($male): void
    {
        $this->male = $male;
    }

    /**
     * @return mixed
     */
    public function getFemale()
    {
        return $this->female;
    }

    /**
     * @param mixed $female
     */
    public function setFemale($female): void
    {
        $this->female = $female;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }
}
