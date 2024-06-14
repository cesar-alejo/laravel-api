<?php

namespace App\Http\Controllers\api;

use Illuminate\Support\Facades\DB;

use App\Class\ApiResponseHelper;
use App\Interfaces\FileRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\FileResource;
use App\Http\Requests\File\StoreApiRequest;
use App\Http\Requests\File\UpdateApiRequest;

class FileController extends Controller
{
    private FileRepositoryInterface $fileRepositoryInterface;

    /**
     * Veneficios
     *  Desacoplamiento: Codigo ma smodular y facil de mantener
     *  Inversión de control: Controlador solicite sus dependencias
     *
     * @param FileRepositoryInterface $fileRepositoryInterface
     */
    public function __construct(FileRepositoryInterface $fileRepositoryInterface)
    {
        $this->fileRepositoryInterface = $fileRepositoryInterface;
    }

    public function index()
    {
        $data = $this->fileRepositoryInterface->getAll();
        return ApiResponseHelper::sendResponse(FileResource::collection($data), '', 200);
    }

    public function show(string $id)
    {
        $file = $this->fileRepositoryInterface->getById($id);
        return ApiResponseHelper::sendResponse(new FileResource($file), '', 200);
    }

    public function store(StoreApiRequest $request)
    {
        $data = [
            'name' => $request->name,
            'expiration' => $request->expiration,
            'details' => $request->details,
            'user_id' => $request->user_id
        ];

        DB::beginTransaction();
        try {
            $file = $this->fileRepositoryInterface->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new FileResource($file), 'Record create succesfull', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponseHelper::rollback($e);
        }
    }

    public function update(UpdateApiRequest $request, string $id)
    {
        $data = [
            'name' => $request->name,
            'expiration' => $request->expiration,
            'details' => $request->details,
            'user_id' => $request->user_id
        ];

        DB::beginTransaction();
        try {
            $this->fileRepositoryInterface->update($data, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse(null, 'Record updated succesfull', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponseHelper::rollback($e);
        }
    }

    public function destroy(string $id)
    {
        $this->fileRepositoryInterface->delete($id);
        return ApiResponseHelper::sendResponse(null, 'Record deleted succesful', 200);
    }
}
