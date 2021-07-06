<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    public $table = "medias";
    public $guarded = [];

    public function mediable() {
        return $this->morphTo();
    }

    public function scopeImageByTaille($query, $taille) {
        $tab_image = explode('.', $this->name);
        return $tab_image[0].'_'.$taille.'.'.$tab_image[1];
    }

    public function scopeByIdType($query, $id, $type) {
        return $query->where('mediable_id', $id)->where('mediable_type', $type);
    }

    public function scopeDefaultByIdType($query, $id, $type) {
        return $query->where('mediable_id', $id)->where('mediable_type', $type)->where('default', 1);
    }

    public function scopeNonDefaultByIdType($query, $id, $type) {
        return $query->where('mediable_id', $id)->where('mediable_type', $type)->where('default', 0);
    }
    public function scopeAllByIdType($query, $id, $type) {
        return $query->where('mediable_id', $id)->where('mediable_type', $type)->orderBy('default');
    }
}
