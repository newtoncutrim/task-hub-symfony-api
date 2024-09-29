<?php

namespace App\Services;

use App\Repository\UserRepository;

class UserService
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->getAll();
    }

    public function createNewUser($data)
    {
        $data = $this->userRepository->create($data);
        if($data instanceof \Exception) {
            return ['status' => false, 'message' => $data->getMessage()];
        }
        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function updateUser($id, $data)
    {
        $data = $this->userRepository->update($id, $data);
        if($data instanceof \Exception) {
            return ['status' => false, 'message' => $data->getMessage()];
        }
        return [
            'status' => true,
            'data' => $data
        ];
    }

    public function deleteUser($id)
    {
        $data = $this->userRepository->delete($id);
        if($data instanceof \Exception) {
            return ['status' => false, 'message' => $data->getMessage()];
        }
        return [
            'status' => true,
            'data' => 'User deleted successfully'
        ];
    }
}