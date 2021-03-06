<?php

namespace HVG\AccessControlBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use HVG\AccessControlBundle\Form\PersonType;

class GuestType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $community = $options['community'];
        $builder
/*
            ->add('unit', null, array(
                'label' => 'guest.form.unit',
                'translation_domain' => 'HVGAccessControlBundle',
                'required' => true,
                'placeholder' => 'Seleccione Unidad',
                'choices' => $community->getUnits(),
                'attr' => array('label_col' => 3, 'widget_col' => 9),
                'choice_label' => function($unit) {
                    return $unit->getUnitGroup()->getName() . ' ' . $unit->getName();
                }
            ))
*/
            ->add('people', 'bootstrap_collection', array(
                'label' => 'guest.form.people',
                'translation_domain' => 'HVGAccessControlBundle',
                'entry_type' => new PersonType(),
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'add_button_text' => 'guest.form.addperson',
                'attr' => array('label_col' => 3, 'widget_col' => 9),
            ))
            ->add('carlicence', null, array(
                'label' => 'guest.form.carlicence',
                'translation_domain' => 'HVGAccessControlBundle',
                'required' => false,
                'attr' => array('label_col' => 3, 'widget_col' => 9, 'class' => 'input input-lg', 'maxlength' => 40),
            ))
            ->add('guestcarpark', null, array(
                'label' => 'guest.form.guestcarpark',
                'translation_domain' => 'HVGAccessControlBundle',
                'required' => false,
                'placeholder' => 'Seleccione Estacionamiento',
                'choices' => $community->getGuestCarparks(),
                'attr' => array('label_col' => 3, 'widget_col' => 9, 'class' => 'input input-lg'),
                'choice_label' => function($guestcarpark) {
                    return $guestcarpark->getName();
                }
            ))
            ->add('note', null, array(
                'label' => 'guest.form.note',
                'translation_domain' => 'HVGAccessControlBundle',
                'required' => false,
                'attr' => array('label_col' => 3, 'widget_col' => 9, 'class' => 'input input-lg'),
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\SystemBundle\Entity\Guest',
            'community' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_accesscontrolbundle_guest';
    }


}
