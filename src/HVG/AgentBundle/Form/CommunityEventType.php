<?php

namespace HVG\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityRepository;

class CommunityEventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'communityevent.form.name',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
            ))
            ->add('startedAt', null, array(
                'label' => 'communityevent.form.startedAt',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
            ))
            ->add('finnishedAt', null, array(
                'label' => 'communityevent.form.finnishedAt',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
            ))
            ->add('units', null, array(
                'label' => 'communityevent.form.units',
                'attr'  => array( 'label_col' => 4, 'widget_col' => 8 ),
                'translation_domain' => 'HVGAgentBundle',
                'required' => true,
                'expanded' => true,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('u')
                        ->where('u.community = :community')
                        ->setParameter('community', $options['community'])
                    ;
                },
            ))
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HVG\SystemBundle\Entity\CommunityEvent',
            'community' => null,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'hvg_agentbundle_communityevent';
    }

}
