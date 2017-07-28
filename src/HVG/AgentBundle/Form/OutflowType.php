<?php

namespace HVG\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use HVG\AgentBundle\Form\Type\EntityTableType;
use HVG\SystemBundle\Entity\ExpenditureRepository;
use HVG\AgentBundle\Form\EventListener\AddExpenditureFieldSubscriber;

class OutflowType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('community', null, array(
                'label' => 'outflow.form.community',
                'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
            ))
            ->addEventSubscriber(new AddExpenditureFieldSubscriber($options['community']))
/*
            ->add('expenditures', new EntityTableType(), array(
                'class' => 'HVGSystemBundle:Expenditure',
                'label' => 'outflow.form.expenditures',
                'attr' => array( 'label_col' => 4, 'widget_col' => 8 ),
                'choice_label' => 'info',
                'translation_domain' => 'HVGAgentBundle',
                'by_reference' => false,
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function(ExpenditureRepository $er ) {
                    return $er->createQueryBuilder('e')
                        ->where('e.outflow is NULL')
                    ;
                },
            ))
*/
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'community' => null,
            'data_class' => 'HVG\SystemBundle\Entity\Outflow',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_agentbundle_outflow';
    }


}
