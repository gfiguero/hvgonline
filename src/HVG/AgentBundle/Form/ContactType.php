<?php

namespace HVG\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contactkind', null, array(
                'label' => 'contact.form.contactkind',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 6 ),
                'translation_domain' => 'HVGAgentBundle',
            ))
            ->add('content', null, array(
                'label' => 'contact.form.content',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 6 ),
                'translation_domain' => 'HVGAgentBundle',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\SystemBundle\Entity\Contact'
        ));
    }

    public function getBlockPrefix()
    {
        return 'hvg_agentbundle_contact';
    }


}
