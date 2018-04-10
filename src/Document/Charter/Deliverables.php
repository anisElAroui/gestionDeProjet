<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 10/04/18
 * Time: 10:52
 */

namespace App\Document\Charter;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @MongoDB\Document
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

}