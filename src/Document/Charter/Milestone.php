<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 10/04/18
 * Time: 11:41
 */

namespace App\Document\Charter;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 *
 */
class Milestone
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $executiveMilestones;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $estimatedDuration;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $estimatedCompletionTimeframe;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $comments;

    /**
     * Milestone constructor.
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
    public function getExecutiveMilestones()
    {
        return $this->executiveMilestones;
    }

    /**
     * @param mixed $executiveMilestones
     */
    public function setExecutiveMilestones($executiveMilestones): void
    {
        $this->executiveMilestones = $executiveMilestones;
    }

    /**
     * @return mixed
     */
    public function getEstimatedDuration()
    {
        return $this->estimatedDuration;
    }

    /**
     * @param mixed $estimatedDuration
     */
    public function setEstimatedDuration($estimatedDuration): void
    {
        $this->estimatedDuration = $estimatedDuration;
    }

    /**
     * @return mixed
     */
    public function getEstimatedCompletionTimeframe()
    {
        return $this->estimatedCompletionTimeframe;
    }

    /**
     * @param mixed $estimatedCompletionTimeframe
     */
    public function setEstimatedCompletionTimeframe($estimatedCompletionTimeframe): void
    {
        $this->estimatedCompletionTimeframe = $estimatedCompletionTimeframe;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }


}