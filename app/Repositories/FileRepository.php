<?php

namespace App\Repositories;

use App\Interfaces\FileRepositoryInterface;
use App\Models\File;

class FileRepository implements FileRepositoryInterface
{
    public function getAll()
    {
        return File::orderBy('id', 'DESC')->get();
        //return File::all();
    }

    public function getById($id)
    {
        return File::findOrFail($id);
    }

    public function store(array $data)
    {
        return File::create($data);
    }

    public function update(array $data, $id)
    {
        return File::whereId($id)->update($data);
    }

    public function delete($id)
    {
        return File::destroy($id);
    }
}
