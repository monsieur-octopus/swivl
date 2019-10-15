<?php

namespace App\Controller;

use App\DTO\ClassroomDTO;
use App\DTO\Transformer\ClassroomTransformer;
use App\Handler\ClassroomHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ClassroomController extends ApiController
{
    private $handler;
    private $validator;
    private $transformer;

    public function __construct(
        ClassroomHandler $handler,
        ClassroomTransformer $transformer,
        ValidatorInterface $validator
    ) {
        $this->handler = $handler;
        $this->validator = $validator;
        $this->transformer = $transformer;

        parent::__construct();
    }

    public function getOne(int $id)
    {
        $classroom = $this->handler->get($id);

        return $this->json([
            'status' => Response::HTTP_OK,
            'data'   => $classroom
        ]);
    }

    public function getList(int $page)
    {
        $page = ($page > 0 ? $page : 1) - 1;
        $classrooms = $this->handler->all(10, $page);

        return $this->json([
            'status' => Response::HTTP_OK,
            'data'   => $classrooms
        ]);
    }

    public function add(Request $request)
    {
        $json = $request->getContent();

        $dto = $this->serializer->deserialize($json, ClassroomDTO::class, 'json');
        $dto->active = true;
        $dto->createdAt = new \DateTime();

        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            return $this->jsonError($errors, Response::HTTP_BAD_REQUEST);
        }

        $classroom = $this->handler->create($dto);

        return $this->json([
            'status' => Response::HTTP_CREATED,
            'id'     => $classroom->getId()
        ]);
    }

    public function edit(int $id, Request $request)
    {
        $classroom = $this->handler->get($id);
        $dto = $this->transformer->convertToDto($classroom);

        $json = $request->getContent();
        $dto = $this->serializer->deserialize(
            $json,
            ClassroomDTO::class,
            'json',
            ['object_to_populate' => $dto]
        );

        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            return $this->jsonError($errors, Response::HTTP_BAD_REQUEST);
        }

        $classroom = $this->handler->update($classroom, $dto);

        return $this->json([
            'status' => Response::HTTP_OK,
            'data'   => $classroom
        ]);
    }

    public function setActive(int $id, bool $active, Request $request)
    {
        $classroom = $this->handler->get($id);
        $dto = $this->transformer->convertToDto($classroom);
        $dto->active = $active;

        $classroom = $this->handler->update($classroom, $dto);

        return $this->json([
            'status' => Response::HTTP_OK,
            'data'   => $classroom
        ]);
    }

    public function delete(int $id)
    {
        $this->handler->delete($id);

        return $this->json(['status' => Response::HTTP_OK]);
    }
}