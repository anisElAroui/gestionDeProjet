<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 10/04/18
 * Time: 17:30
 */

namespace App\Document\Charter;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\EmbeddedDocument
 *
 */
class Budget
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $expenses;

    /**
     * @MongoDB\Field(type="boolean")
     */
    protected $incomes;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $profile;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $estimatedDurationBudget;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $estimatedCost;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $budgetComments;

    /**
     * budget constructor.
     */
    public function __construct()
    {
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
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * @param mixed $profile
     */
    public function setProfile($profile): void
    {
        $this->profile = $profile;
    }

    /**
     * @return mixed
     */
    public function getEstimatedDurationBudget()
    {
        return $this->estimatedDurationBudget;
    }

    /**
     * @param mixed $estimatedDurationBudget
     */
    public function setEstimatedDurationBudget($estimatedDurationBudget): void
    {
        $this->estimatedDurationBudget = $estimatedDurationBudget;
    }

    /**
     * @return mixed
     */
    public function getEstimatedCost()
    {
        return $this->estimatedCost;
    }

    /**
     * @param mixed $estimatedCost
     */
    public function setEstimatedCost($estimatedCost): void
    {
        $this->estimatedCost = $estimatedCost;
    }

    /**
     * @return mixed
     */
    public function getBudgetComments()
    {
        return $this->budgetComments;
    }

    /**
     * @param mixed $budgetComments
     */
    public function setBudgetComments($budgetComments): void
    {
        $this->budgetComments = $budgetComments;
    }


}