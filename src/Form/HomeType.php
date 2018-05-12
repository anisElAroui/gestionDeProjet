<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 12/05/18
 * Time: 00:26
 */

namespace App\Form;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HomeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('expenses')
            ->add('realStartDate',DateType::class)
            ->add('plannedEndDate',DateType::class)
            ->add('done')
            ->add('endDate',DateType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Document\Project'
        ));
    }
}