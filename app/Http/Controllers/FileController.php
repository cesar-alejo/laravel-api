<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Interfaces\FileRepositoryInterface;
use App\Http\Resources\FileResource;
use App\Http\Requests\File\StoreRequest;
use App\Http\Requests\File\PutRequest;

class FileController extends Controller
{
    private FileRepositoryInterface $fileRepositoryInterface;

    public function __construct(FileRepositoryInterface $fileRepositoryInterface)
    {
        $this->fileRepositoryInterface = $fileRepositoryInterface;
    }

    public function index()
    {
        $files = FileResource::collection($this->fileRepositoryInterface->getAll());
        return view('files.index', compact('files'));
    }

    public function show(string $id)
    {
        $file = new FileResource($this->fileRepositoryInterface->getById($id));
        return view('files.show', compact('file'));
    }

    public function create()
    {
        return view('files.create');
    }

    public function store(StoreRequest $request)
    {
        $data = [
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'expiration' => $request->expiration,
            'details' => $request->details
        ];

        DB::beginTransaction();
        try {
            $this->fileRepositoryInterface->store($data);
            DB::commit();

            session()->flash('status', 'Record create succesfull');
            //return ApiResponseHelper::sendResponse(new FileResource($file), 'Record create succesfull', 201);
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('status', 'ERROR: ' . $e->getMessage());
            //return ApiResponseHelper::rollback($e);
        }

        // Get File | Mov File | Pend create table files
        //$attachment = $request->file('attachment');
        //$filePath = $attachment->storeAs('uploads', $attachment->hashName(), 'public');
        //$file->file_name = $attachment->getClientOriginalName();
        //$file->mime_type = $attachment->getMimeType();
        //$file->extension = $attachment->getClientOriginalExtension();
        //$file->size = number_format($attachment->getSize() / 1024, 2);
        //$file->disk = 'uploads';
        //$file->path = $filePath;
        //$file->save();

        return to_route('files.index');
    }

    public function edit(string $id)
    {
        //
    }

    public function update(PutRequest $request, string $id)
    {
    }

    public function destroy(string $id)
    {
        $this->fileRepositoryInterface->delete($id);
        return ['id' => $id, 'status' => 'Record succesfully deleted'];
    }
}
