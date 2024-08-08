<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Models\Attachment;

class AttachmentController extends Controller
{

    public function attachTo(Request $request, string $model, string $id)
    {
        $val = Validator::make($request->all(), [
            'file' => 'required|file|mimes:png,jpg,jpeg,pdf,xls,xlsx,ods|max:5120',
        ]);

        if ($val->fails()) {
            return response()->json(['errors' => $val->errors()], 422);
        }

        $modelClass = $this->getModelClass($model);

        $modelInstance = $modelClass::findOrFail($id);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            //! Pend. estructura bodegas..
            $path = Storage::disk('public')->put('attachments', $file);
            //$path = $file->storeAs('uploads', $file->hashName(), 'public');

            // Crear el attachment
            $attachment = new Attachment([
                'user_id' => auth()->user()->id,
                'file_path' => $path,
                'file_type' => $file->getClientOriginalExtension(),
                'file_name' => $file->getClientOriginalName(),
                'file_size' => number_format($file->getSize() / 1024, 2),
                'mime_type' => $file->getMimeType(),
                'disk' => 'attachments'
            ]);

            // Asociar el attachment al modelo
            $modelInstance->attachments()->save($attachment);

            return response()->json([
                'success' => true,
                'message' => 'File attached successfully',
                'attachment' => $attachment
            ], 201);
        }

        return response()->json(['success' => false, 'message' => 'No file uploaded'], 400);
    }

    public function detachFrom(Request $request, $model, $id, $attachmentId)
    {
        $modelClass = $this->getModelClass($model);

        // Encontrar la instancia del modelo
        $modelInstance = $modelClass::findOrFail($id);

        // Buscar el attachment a eliminar
        $attachment = $modelInstance->attachments()->findOrFail($attachmentId);

        // Eliminar el archivo del disco
        Storage::disk('public')->delete($attachment->file_path);

        // Eliminar el registro del attachment
        $attachment->delete();

        return response()->json([
            'message' => 'Attachment deleted successfully'
        ], 200);
    }

    private function getModelClass($model)
    {
        // Mapeo de nombres de modelos a clases
        $modelMap = [
            'users' => \App\Models\User::class,
            'files' => \App\Models\File::class,
        ];

        return $modelMap[$model] ?? null;
    }
}
