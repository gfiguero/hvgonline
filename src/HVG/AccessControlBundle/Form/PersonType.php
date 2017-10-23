<?php

namespace HVG\AccessControlBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rut', null, array(
                'label' => 'person.form.rut',
                'translation_domain' => 'HVGAccessControlBundle',
                'required' => true,
                'attr' => array('class' => 'input rut', 'label_col' => 3, 'widget_col' => 9),
            ))
//            ->add('search', 'button', array(
//                'label' => false,
//                'button_class' => 'default btn-lg',
//                'attr' => array('icon' => 'search fa-fw'),
//            ))
            ->add('name', null, array(
                'label' => 'person.form.name',
                'translation_domain' => 'HVGAccessControlBundle',
                'required' => true,
                'attr' => array('class' => 'input', 'label_col' => 3, 'widget_col' => 9),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\SystemBundle\Entity\Person',
            'attr' => array('style' => 'horizontal')
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_accesscontrolbundle_person';
    }


}
