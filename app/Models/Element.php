<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeImageByTaille($query, $taille) {
        $tab_image = explode('.', $this->name);
        return $tab_image[0].'_'.$taille.'.'.$tab_image[1];
    }

    public function getImageDir() {
        switch ($this->type) {
            case 1: $dir_elem = 'images'; break;
            case 2: $dir_elem = 'pdf'; break;
            default: $dir_elem = 'files'; break;
        }
        return 'storage/uploads/elements/'.$dir_elem.'/'.ceil($this->id / 1000);
    }
}
