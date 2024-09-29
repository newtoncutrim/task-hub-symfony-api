<?php

namespace App\Controller\Api;

use App\Services\UserService;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class UserController extends AbstractController
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    #[Route('/users', name: 'app_api_user', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $data = $this->userService->getAllUsers();

        if(empty($data)) {
            return $this->json([
                'message' => 'No users found',
            ]);
        }

        return $this->json($data, 200);
    }

    #[Route('/user/create', name: 'app_api_user_create', methods: ['POST'])]
    public function createNewUser(Request $request)
    {
        $data = $this->userService->createNewUser($request->toArray());

        if(!$data['status']) {
            return $this->json([
                'status' => $data['status'],
                'message' => $data['message'],
            ]);
        }

        return $this->json([
            'status' => $data['status'],
            'data' => $data['data'],
        ]);
    }

    #[Route('/user/update/{id}', name: 'app_api_user_update', methods: ['PUT'])]
    public function updateUser($id, Request $request)
    {
        $data = $this->userService->updateUser($id, $request->toArray());
        if(!$data['status']) {
            return $this->json([
                'status' => $data['status'],
                'message' => $data['message'],
            ]);
        }

        return $this->json([
            'status' => $data['status'],
            'data' => $data['data'],
        ]);
    }

    #[Route('/user/delete/{id}', name: 'app_api_user_delete', methods: ['DELETE'])]
    public function deleteUser($id)
    {
        $data = $this->userService->deleteUser($id);
        if(!$data['status']) {
            return $this->json([
                'status' => $data['status'],
                'message' => $data['message'],
            ]);
        }

        return $this->json([
            'status' => $data['status'],
            'data' => $data['data'],
        ]);
    }
}
