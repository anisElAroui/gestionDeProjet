<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 10/04/18
 * Time: 11:54
 */

namespace App\Form\Charter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MilestoneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('executiveMilestones')
            ->add('estimatedDuration')
            ->add('estimatedCompletionTimeframe',DateType::class)
            ->add('comments');
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Document\Charter\Milestone'
        ));
    }

}