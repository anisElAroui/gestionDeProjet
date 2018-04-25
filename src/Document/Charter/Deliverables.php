<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 10/04/18
 * Time: 10:52
 */

namespace App\Document\Charter;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\EmbeddedDocument
 *
 */
class Deliverables
{

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $majorDeliverables;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $deliverablesDescription;

    /**
     * Deliverables constructor.
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
    public function getMajorDeliverables()
    {
        return $this->majorDeliverables;
    }

    /**
     * @param mixed $majorDeliverables
     */
    public function setMajorDeliverables($majorDeliverables): void
    {
        $this->majorDeliverables = $majorDeliverables;
    }

    /**
     * @return mixed
     */
    public function getDeliverablesDescription()
    {
        return $this->deliverablesDescription;
    }

    /**
     * @param mixed $deliverablesDescription
     */
    public function setDeliverablesDescription($deliverablesDescription): void
    {
        $this->deliverablesDescription = $deliverablesDescription;
    }



}