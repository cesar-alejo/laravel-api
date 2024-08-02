<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

use App\Models\File;
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
        $user = Auth::user();

        if ($user->can('viewAny', File::class)) {

            $files = $this->fileRepositoryInterface->getAll();
        } else {

            $files = $this->fileRepositoryInterface->getAllForUser($user);
        }

        $files = FileResource::collection($files);

        return view('files.index', compact('files'));
    }

    public function show(string $id)
    {
        $file = $this->fileRepositoryInterface->getById($id);
        if (Gate::denies('view', $file)) {
            throw new \Illuminate\Auth\Access\AuthorizationException; //abort(404);
        }

        $file = new FileResource($file);
        return view('files.show', compact('file'));
    }

    public function attach(string $id)
    {
        $file = new FileResource($this->fileRepositoryInterface->getById($id));
        return view('files.attach', compact('file'));
    }

    public function upload(Request $request, string $id)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = '/images';
            //$path = $file->store('uploads');

            return response()->json(['success' => true, 'path' => $path, 'id' => $id]);
        }

        return response()->json(['success' => false], 400);
    }

    public function recip(string $id)
    {
        return "Recip | Indevelopment...";
        //$file = new FileResource($this->fileRepositoryInterface->getById($id));
        //return view('files.show', compact('file'));
    }

    public function history(string $id)
    {
        return "History | Indevelopment...";
        //$file = new FileResource($this->fileRepositoryInterface->getById($id));
        //return view('files.show', compact('file'));
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

            session()->flash('success', 'Record create succesfull');
            //return ApiResponseHelper::sendResponse(new FileResource($file), 'Record create succesfull', 201);
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('error', 'ERROR: ' . $e->getMessage());
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

    public function destroy(Request $request, string $id)
    {
        $data = [
            'details' => $request->input('details') ? $request->input('details') : 'Elimina repositorio.'
        ];

        $this->fileRepositoryInterface->delete($data, $id);
        return ['id' => $id, 'status' => 'Record succesfully deleted'];
    }
}
