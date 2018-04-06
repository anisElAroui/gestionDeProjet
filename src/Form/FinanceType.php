<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 04/04/18
 * Time: 10:29
 */

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FinanceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('budget')
            ->add('sellingPrice')
            ->add('Deadline')
            ->add('expensesPlanned')
            ->add('currentExpenses')


        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Document\Finance'
        ));
    }

}