<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 11/04/18
 * Time: 09:10
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 *
 */
class Action
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $actionType;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $priority;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $initialDate;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $author;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $status;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $currentDate;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $realDate;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $identificator;

    /**
     * Action constructor.
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
    public function getActionType()
    {
        return $this->actionType;
    }

    /**
     * @param mixed $actionType
     */
    public function setActionType($actionType): void
    {
        $this->actionType = $actionType;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @param mixed $priority
     */
    public function setPriority($priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return mixed
     */
    public function getInitialDate()
    {
        return $this->initialDate;
    }

    /**
     * @param mixed $initialDate
     */
    public function setInitialDate($initialDate): void
    {
        $this->initialDate = $initialDate;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getCurrentDate()
    {
        return $this->currentDate;
    }

    /**
     * @param mixed $currentDate
     */
    public function setCurrentDate($currentDate): void
    {
        $this->currentDate = $currentDate;
    }

    /**
     * @return mixed
     */
    public function getRealDate()
    {
        return $this->realDate;
    }

    /**
     * @param mixed $realDate
     */
    public function setRealDate($realDate): void
    {
        $this->realDate = $realDate;
    }

    /**
     * @return mixed
     */
    public function getIdentificator()
    {
        return $this->identificator;
    }

    /**
     * @param mixed $identificator
     */
    public function setIdentificator($identificator): void
    {
        $this->identificator = $identificator;
    }

}