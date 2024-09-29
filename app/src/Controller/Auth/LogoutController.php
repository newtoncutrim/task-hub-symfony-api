<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LogoutController extends AbstractController
{
    #[Route('/auth/logout', name: 'app_auth_logout')]
    public function index(): Response
    {
        return $this->render('auth/logout/index.html.twig', [
            'controller_name' => 'LogoutController',
        ]);
    }
}
