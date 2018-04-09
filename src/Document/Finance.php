<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 04/04/18
 * Time: 09:09
 */

namespace App\Document;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 *
 */
class Finance
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $budget;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $sellingPrice;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $Deadline;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $expensesPlanned;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $currentExpenses;

    /**
     * Finance constructor.
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
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    /**
     * @param mixed $sellingPrice
     */
    public function setSellingPrice($sellingPrice): void
    {
        $this->sellingPrice = $sellingPrice;
    }

    /**
     * @return mixed
     */
    public function getDeadline()
    {
        return $this->Deadline;
    }

    /**
     * @param mixed $Deadline
     */
    public function setDeadline($Deadline): void
    {
        $this->Deadline = $Deadline;
    }

    /**
     * @return mixed
     */
    public function getExpensesPlanned()
    {
        return $this->expensesPlanned;
    }

    /**
     * @param mixed $expensesPlanned
     */
    public function setExpensesPlanned($expensesPlanned): void
    {
        $this->expensesPlanned = $expensesPlanned;
    }

    /**
     * @return mixed
     */
    public function getCurrentExpenses()
    {
        return $this->currentExpenses;
    }

    /**
     * @param mixed $currentExpenses
     */
    public function setCurrentExpenses($currentExpenses): void
    {
        $this->currentExpenses = $currentExpenses;
    }


}