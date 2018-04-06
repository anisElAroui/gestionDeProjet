<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 28/03/18
 * Time: 10:30
 */

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class ProjectType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('projectName')
            ->add('description', TextareaType::class)
            ->add('projectManager', ChoiceType::class, array(
                'choices'  => array(
                    'project manager 1' => null,
                    'project manager 2' => null,
                    'project manager 3' => null,
                ),))
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