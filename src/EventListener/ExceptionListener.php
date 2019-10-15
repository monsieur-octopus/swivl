<?php

namespace App\EventListener;

use Doctrine\ORM\EntityNotFoundException;
use DomainException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getException();
        $response = null;

        if ($exception instanceof DomainException) {
            $response = $this->getJsonError($exception->getMessage(), Response::HTTP_CONFLICT);
        }

        if ($exception instanceof EntityNotFoundException) {
            $response = $this->getJsonError('Classroom not found', Response::HTTP_NOT_FOUND);
        }

        if ($exception instanceof NotFoundHttpException) {
            $response = $this->getJsonError('Route not found', Response::HTTP_NOT_FOUND);
        }

        if (is_null($response)) {
            $response = $this->getJsonError('Unexpected error :(', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }

    private function getJsonError(string $message, int $status)
    {
        return new JsonResponse([
            'status'  => $status,
            'message' => $message
        ]);
    }
}