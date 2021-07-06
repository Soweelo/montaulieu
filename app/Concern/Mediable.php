<?php


namespace App\Concern;

use App\Media;

trait Mediable
{
    public function saveMedia($media) {
        $type = get_class($this);
        $id = $this->id;
        $name = $media['name'];

        // on regarde si on a déjà un média du même nom pour le même objet
        $old_media = Media::where('mediable_id', $id)
            ->where('mediable_type', $type)
            ->where('name', $name)
            ->first();

        if ($old_media) {
            // on met à jour le media
            $data = array();
            if (isset($media['caption'])) {
                $data['caption'] = $media['caption'];
            }
            if (isset($media['video'])) {
                $data['video'] = $media['video'];
            }
            if (isset($media['default'])) {
                $data['default'] = $media['default'];
            }
            $old_media->update($data);
        } else {
            // on insère le media
            $data = array(
                'mediable_id'     => $id,
                'mediable_type'   => $type,
                'name'   => $name,
                'type' => $media['type'],
                'default' => $media['default']
            );
            if (isset($media['caption'])) {
                $data['caption'] = $media['caption'];
            }
            if (isset($media['video'])) {
                $data['video'] = $media['video'];
            }
            Media::create($data);
        }
    }

    public function deleteMedias() {
        Media::where('mediable_id', $this->id)->where('mediable_type', get_class($this))->delete();
    }
}
