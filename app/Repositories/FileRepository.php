<?php

namespace App\Repositories;

use App\Interfaces\FileRepositoryInterface;
use App\Models\File;
use App\Models\FileHistory;

class FileRepository implements FileRepositoryInterface
{
    public function getAll()
    {
        return File::with('user')->withCount('attachments')->paginate(5);

        //return File::orderBy('id', 'DESC')->get();
        //return File::all();
    }

    public function getAllForUser($id)
    {
        return File::where('user_id', auth()->id())
            ->with('user')->withCount('attachments')->paginate(5);
    }

    public function getById($id)
    {
        return File::with('user')->withCount('attachments')->findOrFail($id);
    }

    public function store(array $data)
    {
        $file = File::create($data);

        $file->histories()->create([
            'user_id' => auth()->user()->id,
            'ttr_id' => 1,
            'details' => 'Creación'
        ]);

        return $file;
    }

    public function update(array $data, $id)
    {
        $data = array(
            'file_id' => $id,
            'user_id' => auth()->user()->id,
            'ttr_id' => 2,
            'details' => 'Actualización',
        );

        FileHistory::create($data);

        return File::whereId($id)->update($data);
    }

    public function delete(array $data, $id)
    {
        /**
         * !2024-07-08: Boora registro y relaciones
         */
        $data = array(
            'file_id' => $id,
            'user_id' => auth()->user()->id,
            'ttr_id' => 3,
            'details' => $data['details'],
        );

        FileHistory::create($data);

        return File::destroy($id);
    }
}
