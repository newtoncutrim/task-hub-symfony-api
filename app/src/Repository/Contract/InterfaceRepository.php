<?php

namespace App\Repository\Contract;

interface InterfaceRepository
{
    public function getAll();

    public function create($data);

    public function update($id, $data);

    public function findById($id);

    public function delete($id);
}