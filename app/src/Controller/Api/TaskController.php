<?php

namespace App\Controller\Api;

use App\Services\TaskService;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TaskController extends AbstractController
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    
    #[Route('/tasks/{id}', name: 'app_api_task', methods: ['GET'])]
    public function listAllTasksByUser(): JsonResponse
    {
        $data = $this->taskService->getAllTasks();
        if (!$data['status']) {
            return $this->json([
                'status' => $data['status'],
                'message' => $data['message'],
            ]);
        }
        
        return $this->json($data['data']);
    }
}