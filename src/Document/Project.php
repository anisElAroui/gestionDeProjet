<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 04/04/18
 * Time: 15:40
 */

namespace App\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document(repositoryClass="App\Repository\ProjectRepository")
 *
 */
class Project
{
    /**
     * @var integer $id
     *
     * @MongoDB\Id(strategy="INCREMENT")
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $projectName;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $description;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $projectManager;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $poleEbusniss;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $poleEss;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $poleMobile;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $expenses;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $done;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $realStartDate;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $plannedEndDate;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $endDate;

    /**
     * @var integer $charterId
     *
     * @MongoDB\ReferenceOne(targetDocument="App\Document\Charter\Charter", storeAs="id")
     */
    protected $charterId;

    /**
     * Project constructor.
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
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * @param mixed $projectName
     */
    public function setProjectName($projectName): void
    {
        $this->projectName = $projectName;
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
    public function getProjectManager()
    {
        return $this->projectManager;
    }

    /**
     * @param mixed $projectManager
     */
    public function setProjectManager($projectManager): void
    {
        $this->projectManager = $projectManager;
    }

    /**
     * @return mixed
     */
    public function getPoleEbusniss()
    {
        return $this->poleEbusniss;
    }

    /**
     * @param mixed $poleEbusniss
     */
    public function setPoleEbusniss($poleEbusniss): void
    {
        $this->poleEbusniss = $poleEbusniss;
    }

    /**
     * @return mixed
     */
    public function getPoleEss()
    {
        return $this->poleEss;
    }

    /**
     * @param mixed $poleEss
     */
    public function setPoleEss($poleEss): void
    {
        $this->poleEss = $poleEss;
    }

    /**
     * @return mixed
     */
    public function getPoleMobile()
    {
        return $this->poleMobile;
    }

    /**
     * @param mixed $poleMobile
     */
    public function setPoleMobile($poleMobile): void
    {
        $this->poleMobile = $poleMobile;
    }

    /**
     * @return mixed
     */
    public function getExpenses()
    {
        return $this->expenses;
    }

    /**
     * @param mixed $expenses
     */
    public function setExpenses($expenses): void
    {
        $this->expenses = $expenses;
    }

    /**
     * @return mixed
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * @param mixed $done
     */
    public function setDone($done): void
    {
        $this->done = $done;
    }

    /**
     * @return mixed
     */
    public function getRealStartDate()
    {
        return $this->realStartDate;
    }

    /**
     * @param mixed $realStartDate
     */
    public function setRealStartDate($realStartDate): void
    {
        $this->realStartDate = $realStartDate;
    }

    /**
     * @return mixed
     */
    public function getPlannedEndDate()
    {
        return $this->plannedEndDate;
    }

    /**
     * @param mixed $plannedEndDate
     */
    public function setPlannedEndDate($plannedEndDate): void
    {
        $this->plannedEndDate = $plannedEndDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate): void
    {
        $this->endDate = $endDate;
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