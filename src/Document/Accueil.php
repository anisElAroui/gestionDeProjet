<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 27/03/18
 * Time: 10:57
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 *
 */
class Accueil
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $projectName;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $projectManager;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $year;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $realStartDate;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $plannedEndDate;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $budget;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $incomes;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $Expenses;


    /**
     * @MongoDB\Field(type="float")
     */
    protected $done;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $endDate;

    /**
     * Accueil constructor.
     *
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
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
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
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param mixed $budget
     */
    public function setBudget($budget): void
    {
        $this->budget = $budget;
    }

    /**
     * @return mixed
     */
    public function getIncomes()
    {
        return $this->incomes;
    }

    /**
     * @param mixed $incomes
     */
    public function setIncomes($incomes): void
    {
        $this->incomes = $incomes;
    }

    /**
     * @return mixed
     */
    public function getExpenses()
    {
        return $this->Expenses;
    }

    /**
     * @param mixed $Expenses
     */
    public function setExpenses($Expenses): void
    {
        $this->Expenses = $Expenses;
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



}