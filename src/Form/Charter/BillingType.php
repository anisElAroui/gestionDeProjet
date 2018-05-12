<?php

namespace App\Form\Charter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BillingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('billingDescription',TextType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('billingAmount',MoneyType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('billingPlanedDate',DateType::class)
            ->add('billingDeliveredDate',DateType::class);

    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Document\Charter\Billing'
        ));
    }
}