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
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('executiveMilestones',TextType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('estimatedDuration',TextType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('estimatedCompletionTimeframe',DateType::class, array('required' => true))
            ->add('comments',TextType::class, array('attr' => array('class' => 'form-control'), 'required' => true));
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