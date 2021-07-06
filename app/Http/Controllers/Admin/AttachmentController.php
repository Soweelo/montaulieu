<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachmentRequest;
use App\Models\Attachment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    public function store(AttachmentRequest $request) {
        $type = $request->get('attachable_type');
        $id = $request->get('attachable_id');
        $file = $request->file('name');
        if (class_exists($type) && method_exists($type, 'attachments')) {
            $subject = call_user_func($type."::find", $id);
            if ($subject) {
                $attachment = new Attachment($request->only('attachable_type', 'attachable_id'));
                $attachment->uploadFile($file);
                $attachment->save();
                return $attachment;
            } else {
                return new JsonResponse(['attachable_id' => "Ce contenu ne peut pas recevoir de fichier attaché"], 422);
            }
        } else {
            return new JsonResponse(['attachable_type' => "Ce contenu ne peut pas recevoir de fichier attaché"], 422);
        }
    }
}
