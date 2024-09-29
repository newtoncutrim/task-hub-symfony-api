<?php

namespace App\Services;

use App\Repository\TaskRepository;

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks()
    {
        $data = $this->taskRepository->getAll();
        if (empty($data)) {
            return [
                'status' => false,
                'message' => 'No tasks found'
            ];
        }

        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function createNewTask($data)
    {
        $data = $this->taskRepository->create($data);
        if($data instanceof \Exception) {
            return ['status' => false, 'message' => $data->getMessage()];
        }
        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function updateTask($id, $data)
    {
        $data = $this->taskRepository->update($id, $data);
        if($data instanceof \Exception) {
            return ['status' => false, 'message' => $data->getMessage()];
        }
        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function deleteTask($id)
    {
        $data = $this->taskRepository->delete($id);
        if($data instanceof \Exception) {
            return ['status' => false, 'message' => $data->getMessage()];
        }
        return [
            'status' => true,
            'data' => 'Task deleted successfully'
        ];
    }
}