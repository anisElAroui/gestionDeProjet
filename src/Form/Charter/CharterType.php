<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 05/04/18
 * Time: 11:23
 */

namespace App\Form\Charter;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CharterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('projectName')
            ->add('projectManager', ChoiceType::class, array(
                'choices'  => array(
                    'project manager 1' => 'anis',
                    'project manager 2' => null,
                    'project manager 3' => null,
                ),))
            ->add('projectInternalRefrances')
            ->add('finalClient')
            ->add('client')
            ->add('projectDescription', TextareaType::class)
            ->add('projectRepository', TextareaType::class)
            ->add('objectives', TextareaType::class)
            ->add('requirements',CollectionType::class, array(
                'entry_type' => RequirementType::class,
                'allow_add' => true,
                ))
            ->add('deliverables',CollectionType::class, array(
                'entry_type' => DeliverableType::class,
                'allow_add' => true,
            ))
            ->add('milestones',CollectionType::class, array(
                'entry_type' => MilestoneType::class,
                'allow_add' => true,
            ))
            ->add('constraints',CollectionType::class, array(
                'entry_type' => ConstraintType::class,
                'allow_add' => true,
            ))
            ->add('assumptions',CollectionType::class, array(
                'entry_type' => AssumptionType::class,
                'allow_add' => true,
            ))
            ->add('stakeholders',CollectionType::class, array(
                'entry_type' => StakeholderType::class,
                'allow_add' => true,
            ))
            ->add('budget')
            ->add('incomesManDayAffection')
            ->add('agreedWageExpenses')
            ->add('plannedExpensesBudget')
            ->add('targetProfitability')
            ->add('thresholdProfitability')
            ->add('expensesManDayAffection')
            ->add('budgets',CollectionType::class, array(
                'entry_type' => BudgetType::class,
                'allow_add' => true,
            ))
            ->add('billingResponsible')
            ->add('billings',CollectionType::class, array(
                'entry_type' => BillingType::class,
                'allow_add' => true,
            ))

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Document\Charter\Charter',
        ));
    }

}