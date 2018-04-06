<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 28/03/18
 * Time: 10:30
 */

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AccueilType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('projectName')
            ->add('projectManager')
            ->add('year')
            ->add('realStartDate')
            ->add('plannedEndDate')
            ->add('budget')
            ->add('incomes')
            ->add('Expenses')
            ->add('done')
            ->add('endDate')

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Document\Accueil'
        ));
    }
}