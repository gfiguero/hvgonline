<?php

namespace HVG\ServiceControlBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use HVG\ServiceControlBundle\Form\PersonType;

class ServiceLogType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', null, array(
                'label' => 'servicelog.form.description',
                'translation_domain' => 'HVGServiceControlBundle',
                'attr' => array('class' => 'input input-lg'),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\SystemBundle\Entity\ServiceLog',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_accesscontrolbundle_servicelog';
    }


}
