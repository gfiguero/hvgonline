<?php

namespace HVG\AgentBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class PetitionToIdTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (entity) to a integer (id).
     *
     * @param  Entity|null $entity
     * @return hidden
     */
    public function transform($entity)
    {
        if (null === $entity) {
            return '';
        }

        return $entity->getId();
    }

    /**
     * Transforms a integer (id) to an object (entity).
     *
     * @param  integer $id
     * @return Object|null
     * @throws TransformationFailedException if object (entity) is not found.
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            return;
        }

        $ticket = $this->manager->getRepository('HVGSystemBundle:Petition')->find($id);

        if (null === $ticket) {
            throw new TransformationFailedException(sprintf('A ticket with number "%s" does not exist!', $id ));
        }

        return $ticket;
    }
}