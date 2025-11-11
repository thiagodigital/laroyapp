<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MediaUploadRequest;
use App\Models\Media;

class MediaUploadController extends Controller
{
    public function store(MediaUploadRequest $request)
    {
    // Validação (IMPORTANTE!)
        $request->validated();

        $file = $request->file('file');
        $user = $request->user();

        // Determina o tipo de mídia
        $mime = $file->getMimeType();
        $type = 'other';
        if (Str::startsWith($mime, 'image/')) $type = 'image';
        if (Str::startsWith($mime, 'video/')) $type = 'video';
        if (Str::startsWith($mime, 'audio/')) $type = 'audio';

        // Armazena o arquivo
        // Caminho: uploads/[user_id]/[uuid].[ext]
        $path = $file->storeAs(
            'uploads/' . $user->id,
            Str::uuid() . '.' . $file->extension(),
            'public'
        );

        // Salva no banco de dados
        $media = Media::create([
            'user_id' => $user->id,
            'path' => $path,
            'mime_type' => $mime,
            'type' => $type,
            'size' => $file->getSize(),
        ]);

        // Retorna o objeto de mídia (que incluirá a 'url' graças ao Accessor)
        return response()->json($media, 201);
    }
}
