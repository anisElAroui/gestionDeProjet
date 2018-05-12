<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 03/04/18
 * Time: 15:39
 */

namespace App\Form\Charter;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class StakeholderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('role',TextType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('email', EmailType::class, array('attr' => array('class' => 'form-control'), 'required' => true))
            ->add('phoneNumber', NumberType::class, array('attr' => array('class' => 'form-control'), 'required' => true))


        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Document\Charter\Stakeholder'
        ));
    }
}