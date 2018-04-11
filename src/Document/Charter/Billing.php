<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 10/04/18
 * Time: 15:43
 */

namespace App\Document\Charter;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;


/**
 * @MongoDB\Document
 *
 */
class Billing
{
    /**
     * @MongoDB\Id
     */
    protected $id;

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
     * Billing constructor.
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


}