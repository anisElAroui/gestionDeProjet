<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 02/05/18
 * Time: 09:38
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use App\Model\RiskOpportunity;

/**
 * @MongoDB\Document
 *
 */
class Opportunity extends RiskOpportunity
{

}