<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 01/07/18
 * Time: 14:53
 */

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullname')
            ->add('signature',TextareaType::class,array('required' => false))
            ->add('male',RadioType::class,array('required' => false))
            ->add('female',RadioType::class,array('required' => false))
            ->add('image', FileType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Document\User'
        ));
    }

}