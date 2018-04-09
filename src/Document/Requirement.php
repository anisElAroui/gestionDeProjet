<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 06/04/18
 * Time: 14:56
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 *
 */
class Requirement
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $highLevelRequirement;

    /**
     * @MongoDB\ReferenceOne(targetDocument="Charter", inversedBy="requirements")
     */
    private $charter;

    /**
     * Requirement constructor.
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
    public function getHighLevelRequirement()
    {
        return $this->highLevelRequirement;
    }

    /**
     * @param mixed $highLevelRequirement
     */
    public function setHighLevelRequirement($highLevelRequirement): void
    {
        $this->highLevelRequirement = $highLevelRequirement;
    }

    /**
     * @return charter $charter
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