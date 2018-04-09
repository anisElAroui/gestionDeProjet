<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 05/04/18
 * Time: 09:16
 */

namespace App\Document;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @MongoDB\Document
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
     * @MongoDB\ReferenceMany(targetDocument="Requirement", mappedBy="charter")
     */
    protected $requirements;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $majorDeliverables;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $deliverablesDescription;

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
     * @MongoDB\Field(type="string")
     */
    protected $constraints;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $assumptions;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $stakeholderName;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $stakeholderRole;

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
     * @MongoDB\Field(type="string")
     */
    protected $projectBudgetType;

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
     * @MongoDB\Field(type="string")
     */
    protected $billingResponsible;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $billingDescription;

    /**
     * @MongoDB\Field(type="float")
     */
        protected $billingAmount;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $billingPlanedDate;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $billingDeliveredDate;



    /**
     * Charter constructor.
     */
    public function __construct()
    {
        $this->requirements = new ArrayCollection();
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

    /**
     * @return mixed
     */
    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * @param mixed $constraints
     */
    public function setConstraints($constraints): void
    {
        $this->constraints = $constraints;
    }

    /**
     * @return mixed
     */
    public function getAssumptions()
    {
        return $this->assumptions;
    }

    /**
     * @param mixed $assumptions
     */
    public function setAssumptions($assumptions): void
    {
        $this->assumptions = $assumptions;
    }

    /**
     * @return mixed
     */
    public function getStakeholderName()
    {
        return $this->stakeholderName;
    }

    /**
     * @param mixed $stakeholderName
     */
    public function setStakeholderName($stakeholderName): void
    {
        $this->stakeholderName = $stakeholderName;
    }

    /**
     * @return mixed
     */
    public function getStakeholderRole()
    {
        return $this->stakeholderRole;
    }

    /**
     * @param mixed $stakeholderRole
     */
    public function setStakeholderRole($stakeholderRole): void
    {
        $this->stakeholderRole = $stakeholderRole;
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
     * @return mixed
     */
    public function getProjectBudgetType()
    {
        return $this->projectBudgetType;
    }

    /**
     * @param mixed $projectBudgetType
     */
    public function setProjectBudgetType($projectBudgetType): void
    {
        $this->projectBudgetType = $projectBudgetType;
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
     * @return mixed
     */
    public function getBillingDescription()
    {
        return $this->billingDescription;
    }

    /**
     * @param mixed $billingDescription
     */
    public function setBillingDescription($billingDescription): void
    {
        $this->billingDescription = $billingDescription;
    }

    /**
     * @return mixed
     */
    public function getBillingAmount()
    {
        return $this->billingAmount;
    }

    /**
     * @param mixed $billingAmount
     */
    public function setBillingAmount($billingAmount): void
    {
        $this->billingAmount = $billingAmount;
    }

    /**
     * @return mixed
     */
    public function getBillingPlanedDate()
    {
        return $this->billingPlanedDate;
    }

    /**
     * @param mixed $billingPlanedDate
     */
    public function setBillingPlanedDate($billingPlanedDate): void
    {
        $this->billingPlanedDate = $billingPlanedDate;
    }

    /**
     * @return mixed
     */
    public function getBillingDeliveredDate()
    {
        return $this->billingDeliveredDate;
    }

    /**
     * @param mixed $billingDeliveredDate
     */
    public function setBillingDeliveredDate($billingDeliveredDate): void
    {
        $this->billingDeliveredDate = $billingDeliveredDate;
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

}