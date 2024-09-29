<?php

namespace App\Controller\Auth;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractController
{
    #[Route('/auth/login', name: 'app_auth_login')]
    public function index(): Response
    {
        return $this->render('auth/login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }
}
