<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 01/05/18
 * Time: 15:38
 */

namespace App\Form\Charter;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\AbstractType;

class customRequirementTypesCollectionType extends AbstractType
{
    public function getParent() {
        return CollectionType::class;
    }
    public function getName()
    {
        return 'custom_requirement_types_collection_type';
    }
}