<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 05/04/18
 * Time: 11:23
 */

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
                    'project manager 1' => null,
                    'project manager 2' => null,
                    'project manager 3' => null,
                ),))
            ->add('projectInternalRefrances')
            ->add('finalClient')
            ->add('client')
            ->add('projectDescription', TextareaType::class)
            ->add('projectRepository', TextareaType::class)
            ->add('objectives', TextareaType::class)
            ->add('highLevelRequirement')
            ->add('majorDeliverables')
            ->add('deliverablesDescription', TextareaType::class)
            ->add('executiveMilestones')
            ->add('estimatedDuration')
            ->add('estimatedCompletionTimeframe')
            ->add('comments')
            ->add('constraints', TextareaType::class)
            ->add('assumptions', TextareaType::class)
            ->add('stakeholderName')
            ->add('stakeholderRole')
            ->add('budget')
            ->add('incomesManDayAffection')
            ->add('agreedWageExpenses')
            ->add('plannedExpensesBudget')
            ->add('targetProfitability')
            ->add('thresholdProfitability')
            ->add('expensesManDayAffection')
            ->add('profile')
            ->add('estimatedDurationBudget')
            ->add('estimatedCost')
            ->add('budgetComments')
            ->add('projectBudgetType',ChoiceType::class, array(
                'choices'  => array(
                    'incomes' => null,
                    'expenses' => null,
                ),))
            ->add('billingResponsible')
            ->add('billingDescription')
            ->add('billingAmount')
            ->add('billingPlanedDate')
            ->add('billingDeliveredDate')

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Document\Charter'
        ));
    }

}