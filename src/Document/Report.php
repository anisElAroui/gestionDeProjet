<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 20/04/18
 * Time: 11:00
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 *
 */
class Report
{  /**
 * @MongoDB\Id
 */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $conclusion;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $lesson;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $assets;

    /**
     * @MongoDB\ReferenceOne(targetDocument="App\Document\Charter\Charter", storeAs="id")
     */
    protected $charter;

    /**
     * Report constructor.
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
    public function getConclusion()
    {
        return $this->conclusion;
    }

    /**
     * @param mixed $conclusion
     */
    public function setConclusion($conclusion): void
    {
        $this->conclusion = $conclusion;
    }

    /**
     * @return mixed
     */
    public function getLesson()
    {
        return $this->lesson;
    }

    /**
     * @param mixed $lesson
     */
    public function setLesson($lesson): void
    {
        $this->lesson = $lesson;
    }

    /**
     * @return mixed
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * @param mixed $assets
     */
    public function setAssets($assets): void
    {
        $this->assets = $assets;
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