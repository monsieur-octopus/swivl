<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class ApiController extends AbstractController
{
    protected $serializer;

    public function __construct()
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    protected function jsonError(ConstraintViolationListInterface $errors, int $status)
    {
        $response = [
            'status' => $status,
            'errors' => [],
        ];

        foreach ($errors as $error) {
            $response['errors'][] = $error->getMessage();
        }

        return $this->json($response, $status);
    }
}