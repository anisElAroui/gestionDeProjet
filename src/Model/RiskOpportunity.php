<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 02/05/18
 * Time: 09:30
 */

namespace App\Model;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 *
 */
class RiskOpportunity
{
    /**
     * @MongoDB\Id
     */
    protected $id;
    /**
     * @MongoDB\Field(type="string")
     */
    protected $description;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $mainCause;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $impact;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $probability;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $detection;

    /**
     * @MongoDB\ReferenceOne(targetDocument="App\Document\Charter\Charter", storeAs="id")
     */
    protected $charter;

    /**
     * RiskOpportunity constructor.
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getMainCause()
    {
        return $this->mainCause;
    }

    /**
     * @param mixed $mainCause
     */
    public function setMainCause($mainCause): void
    {
        $this->mainCause = $mainCause;
    }

    /**
     * @return mixed
     */
    public function getImpact()
    {
        return $this->impact;
    }

    /**
     * @param mixed $impact
     */
    public function setImpact($impact): void
    {
        $this->impact = $impact;
    }

    /**
     * @return mixed
     */
    public function getProbability()
    {
        return $this->probability;
    }

    /**
     * @param mixed $probability
     */
    public function setProbability($probability): void
    {
        $this->probability = $probability;
    }

    /**
     * @return mixed
     */
    public function getDetection()
    {
        return $this->detection;
    }

    /**
     * @param mixed $detection
     */
    public function setDetection($detection): void
    {
        $this->detection = $detection;
    }

    /**
     * @return mixed
     */
    public function getCharter()
    {
        return $this->charter;
    }

    /**
     * @param mixed $charter
     */
    public function setCharter($charter): void
    {
        $this->charter = $charter;
    }

}