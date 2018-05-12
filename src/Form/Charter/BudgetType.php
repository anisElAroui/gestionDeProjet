<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 10/04/18
 * Time: 22:55
 */

namespace App\Form\Charter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BudgetType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('profile',TextType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('estimatedDurationBudget',MoneyType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('estimatedCost',MoneyType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('budgetComments',TextType::class, array('attr' => array('class' => 'form-control')))
            ->add('projectBudgetType',ChoiceType::class, array(
                'choices'  => array(
                    'incomes' => null,
                    'expenses' => null,
                ),), array('attr' => array('class' => 'form-control'), 'required' => true));

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Document\Charter\Budget'
        ));
    }

}