<?php

namespace App\Repository;

use App\Entity\Classroom;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

class ClassroomRepository extends EntityRepository
{
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, $em->getClassMetadata(Classroom::class));
    }

    public function hasByName(string $name): bool
    {
        return (bool) $this->findOneBy(['name' => $name]);
    }
}