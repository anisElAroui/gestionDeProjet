<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 05/05/18
 * Time: 20:55
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 *
 */
class Negociation
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $accept;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $denie;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $reasons;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $charterId;

    /**
     * Negociation constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
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
     * @return mixed
     */
    public function getAccept()
    {
        return $this->accept;
    }

    /**
     * @param mixed $accept
     */
    public function setAccept($accept): void
    {
        $this->accept = $accept;
    }

    /**
     * @return mixed
     */
    public function getDenie()
    {
        return $this->denie;
    }

    /**
     * @param mixed $denie
     */
    public function setDenie($denie): void
    {
        $this->denie = $denie;
    }

    /**
     * @return mixed
     */
    public function getReasons()
    {
        return $this->reasons;
    }

    /**
     * @param mixed $reasons
     */
    public function setReasons($reasons): void
    {
        $this->reasons = $reasons;
    }

    /**
     * @return mixed
     */
    public function getCharterId()
    {
        return $this->charterId;
    }

    /**
     * @param mixed $charterId
     */
    public function setCharterId($charterId): void
    {
        $this->charterId = $charterId;
    }

}