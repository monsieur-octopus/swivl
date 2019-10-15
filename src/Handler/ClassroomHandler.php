<?php

namespace App\Handler;

use App\DTO\ClassroomDTO;
use App\DTO\Transformer\ClassroomTransformer;
use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;

class ClassroomHandler
{
    private $em;
    private $repository;
    private $transformer;

    public function __construct(
        EntityManagerInterface $em,
        ClassroomRepository $repository,
        ClassroomTransformer $transformer
    ) {
        $this->em = $em;
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    public function get(int $id)
    {
        $classroom = $this->repository->find($id);
        if (is_null($classroom)) {
            throw new EntityNotFoundException();
        }

        return $classroom;
    }

    public function all(int $limit = 10, int $page = 1)
    {
        return $this->repository->findBy([], null, $limit, $page * $limit );
    }

    public function create(ClassroomDTO $classroomDto): Classroom
    {
        if ($this->repository->hasByName($classroomDto->name)) {
            throw new \DomainException('Classroom with such name is already exists');
        }

        $classroom = $this->transformer->createFromDto($classroomDto);

        $this->em->persist($classroom);
        $this->em->flush();

        return $classroom;
    }

    public function update(Classroom $classroom, ClassroomDTO $classroomDto): Classroom
    {
        $classroom = $this->transformer->updateFromDto($classroom, $classroomDto);

        $this->em->persist($classroom);
        $this->em->flush();

        return $classroom;
    }

    public function delete(int $id): void
    {
        $this->em->remove($this->get($id));
        $this->em->flush();
    }
}