<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 05/04/18
 * Time: 09:16
 */

namespace App\Document\Charter;

use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @MongoDB\Document(repositoryClass="App\Repository\CharterRepository")
 *
 */
class Charter
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $title;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $projectName;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $projectManager;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $projectInternalRefrances;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $finalClient;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $client;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $projectDescription;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $projectRepository;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $objectives;

    /**
     * @MongoDB\EmbedMany(targetDocument="Requirement")
     */
    protected $requirements;

    /**
     * @MongoDB\EmbedMany(targetDocument="Deliverables")
     */
    protected $deliverables;

    /**
     * @MongoDB\EmbedMany(targetDocument="Milestone")
     */
    protected $milestones;


    /**
     * @MongoDB\EmbedMany(targetDocument="Constraint")
     */
    protected $constraints;

    /**
     * @MongoDB\EmbedMany(targetDocument="Assumption")
     */
    protected $assumptions;

    /**
     * @MongoDB\EmbedMany(targetDocument="Stakeholder")
     */
    protected $stakeholders;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $budget;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $incomesManDayAffection;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $agreedWageExpenses;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $plannedExpensesBudget;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $targetProfitability;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $thresholdProfitability;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $expensesManDayAffection;

    /**
     * @MongoDB\EmbedMany(targetDocument="budget")
     */
    protected $budgets;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $billingResponsible;

    /**
     * @MongoDB\EmbedMany(targetDocument="Billing")
     */
    protected $billings;

    /**
     * Charter constructor.
     */
    public function __construct()
    {
        $this->requirements = new ArrayCollection();
        $this->deliverables = new ArrayCollection();
        $this->milestones = new ArrayCollection();
        $this->constraints = new ArrayCollection();
        $this->assumptions = new ArrayCollection();
        $this->stakeholders = new ArrayCollection();
        $this->billings = new ArrayCollection();
        $this->budgets = new ArrayCollection();


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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
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
    public function getProjectInternalRefrances()
    {
        return $this->projectInternalRefrances;
    }

    /**
     * @param mixed $projectInternalRefrances
     */
    public function setProjectInternalRefrances($projectInternalRefrances): void
    {
        $this->projectInternalRefrances = $projectInternalRefrances;
    }

    /**
     * @return mixed
     */
    public function getFinalClient()
    {
        return $this->finalClient;
    }

    /**
     * @param mixed $finalClient
     */
    public function setFinalClient($finalClient): void
    {
        $this->finalClient = $finalClient;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client): void
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getProjectDescription()
    {
        return $this->projectDescription;
    }

    /**
     * @param mixed $projectDescription
     */
    public function setProjectDescription($projectDescription): void
    {
        $this->projectDescription = $projectDescription;
    }

    /**
     * @return mixed
     */
    public function getProjectRepository()
    {
        return $this->projectRepository;
    }

    /**
     * @param mixed $projectRepository
     */
    public function setProjectRepository($projectRepository): void
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * @return mixed
     */
    public function getObjectives()
    {
        return $this->objectives;
    }

    /**
     * @param mixed $objectives
     */
    public function setObjectives($objectives): void
    {
        $this->objectives = $objectives;
    }

    /**
     * @return Collection $requirements
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * @param Requirement $requirement
     */
    public function addRequirement(Requirement $requirement)
    {
        $this->requirements[] = $requirement;
    }

    /**
     * @return Collection $deliverables
     */
    public function getDeliverables()
    {
        return $this->deliverables;
    }

    /**
     * @param Deliverables $deliverables
     */
    public function addDeliverables(Deliverables $deliverables): void
    {
        $this->deliverables[] = $deliverables;
    }

    /**
     * @return Collection $milestones
     */
    public function getMilestones()
    {
        return $this->milestones;
    }

    /**
     * @param Milestone $milestones
     */
    public function addMilestones(Milestone $milestones): void
    {
        $this->milestones[] = $milestones;
    }



    /**
     * @return Collection $constraints
     */
    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * @param Constraint $constraints
     */
    public function addConstraints(Constraint $constraints): void
    {
        $this->constraints[] = $constraints;
    }

    /**
     * @return Collection $assumptions
     */
    public function getAssumptions()
    {
        return $this->assumptions;
    }

    /**
     * @param Assumption $assumptions
     */
    public function addAssumptions(Assumption $assumptions): void
    {
        $this->assumptions[] = $assumptions;
    }

    /**
     * @return Collection $stakeholders
     */
    public function getStakeholders()
    {
        return $this->stakeholders;
    }

    /**
     * @param Stakeholder $stakeholders
     */
    public function addStakeholders(Stakeholder $stakeholders): void
    {
        $this->stakeholders[] = $stakeholders;
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
    public function getIncomesManDayAffection()
    {
        return $this->incomesManDayAffection;
    }

    /**
     * @param mixed $incomesManDayAffection
     */
    public function setIncomesManDayAffection($incomesManDayAffection): void
    {
        $this->incomesManDayAffection = $incomesManDayAffection;
    }

    /**
     * @return mixed
     */
    public function getAgreedWageExpenses()
    {
        return $this->agreedWageExpenses;
    }

    /**
     * @param mixed $agreedWageExpenses
     */
    public function setAgreedWageExpenses($agreedWageExpenses): void
    {
        $this->agreedWageExpenses = $agreedWageExpenses;
    }

    /**
     * @return mixed
     */
    public function getPlannedExpensesBudget()
    {
        return $this->plannedExpensesBudget;
    }

    /**
     * @param mixed $plannedExpensesBudget
     */
    public function setPlannedExpensesBudget($plannedExpensesBudget): void
    {
        $this->plannedExpensesBudget = $plannedExpensesBudget;
    }

    /**
     * @return mixed
     */
    public function getTargetProfitability()
    {
        return $this->targetProfitability;
    }

    /**
     * @param mixed $targetProfitability
     */
    public function setTargetProfitability($targetProfitability): void
    {
        $this->targetProfitability = $targetProfitability;
    }

    /**
     * @return mixed
     */
    public function getThresholdProfitability()
    {
        return $this->thresholdProfitability;
    }

    /**
     * @param mixed $thresholdProfitability
     */
    public function setThresholdProfitability($thresholdProfitability): void
    {
        $this->thresholdProfitability = $thresholdProfitability;
    }

    /**
     * @return mixed
     */
    public function getExpensesManDayAffection()
    {
        return $this->expensesManDayAffection;
    }

    /**
     * @param mixed $expensesManDayAffection
     */
    public function setExpensesManDayAffection($expensesManDayAffection): void
    {
        $this->expensesManDayAffection = $expensesManDayAffection;
    }

    /**
     * @return Collection $budgets
     */
    public function getBudgets()
    {
        return $this->budgets;
    }

    /**
     * @param Budget $budgets
     */
    public function addBudgets(Budget $budgets): void
    {
        $this->budgets[] = $budgets;
    }

    /**
     * @return mixed
     */
    public function getBillingResponsible()
    {
        return $this->billingResponsible;
    }

    /**
     * @param mixed $billingResponsible
     */
    public function setBillingResponsible($billingResponsible): void
    {
        $this->billingResponsible = $billingResponsible;
    }

    /**
     * @return Collection $billings
     */
    public function getBillings()
    {
        return $this->billings;
    }

    /**
     * @param Billing $billings
     */
    public function addBillings(Billing $billings): void
    {
        $this->billings[] = $billings;
    }

}