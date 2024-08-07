<?php

namespace App\Interfaces;

interface FileRepositoryInterface
{
    public function getAll();

    public function getAllForUser($id);

    public function getById($id);

    public function store(array $data);

    public function update(array $data, $id);

    public function delete(array $data, $id);
}
