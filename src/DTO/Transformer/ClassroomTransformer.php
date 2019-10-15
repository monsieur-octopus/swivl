<?php

namespace App\DTO\Transformer;

use App\DTO\ClassroomDTO;
use App\Entity\Classroom;

class ClassroomTransformer
{
    public function convertToDto(Classroom $classroom): ClassroomDTO
    {
        $dto = new ClassroomDTO();
        $dto->name = $classroom->getName();
        $dto->active = $classroom->isActive();
        $dto->createdAt = $classroom->getCreatedAt();

        return $dto;
    }

    public function createFromDto(ClassroomDTO $dto): Classroom
    {
        return new Classroom(
            $dto->name,
            $dto->createdAt,
            $dto->active
        );
    }

    public function updateFromDto(Classroom $classroom, ClassroomDTO $dto)
    {
        $classroom->setName($dto->name);
        $classroom->setActive($dto->active);

        return $classroom;
    }
}