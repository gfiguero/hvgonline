<?php

namespace HVG\AgentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Doctrine\Common\Persistence\ObjectManager;
use HVG\AgentBundle\Form\DataTransformer\PetitionToIdTransformer;

class HiddenPetitionType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new PetitionToIdTransformer($this->objectManager);
        $builder->addModelTransformer($transformer);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'invalid_message' => 'The petition does not exist.',
            ))
        ;
    }
    public function getParent()
    {
        return 'hidden';
    }
    public function getName()
    {
        return 'hidden_petition';
    }
}