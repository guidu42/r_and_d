<?php

namespace App\Controller\Async;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/async/users', methods: ['GET'])]
    public function __invoke(): Response {
        return new Response(
            $this->renderView('async/users.html.twig'),
            200,
        );
    }
}