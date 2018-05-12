<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 28/03/18
 * Time: 10:30
 */

namespace App\Form;
use Doctrine\Bundle\MongoDBBundle\Form\Type\DocumentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('poleEbusniss',CheckboxType::class,array('required' => false))
            ->add('poleEss',CheckboxType::class,array('required' => false))
            ->add('poleMobile',CheckboxType::class,array('required' => false))
            ->add('projectManager', DocumentType::class, array(
                'class'        => 'App\Document\User',
                'choice_label' => 'username',
                'multiple'     => false,
                ))
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