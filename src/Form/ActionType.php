<?php
/**
 * Created by PhpStorm.
 * User: anis
 * Date: 11/04/18
 * Time: 09:47
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('actionType')
            ->add('priority')
            ->add('initialDate')
            ->add('author')
            ->add('status')
            ->add('currentDate')
            ->add('realDate')
            ->add('identificator');


        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Document\Action'
        ));
    }

}