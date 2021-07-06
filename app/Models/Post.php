<?php

namespace App\Models;

use App\Behaviour\Datetime;
use App\Behaviour\Sluggable;
use App\Concern\Mediable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use Mediable;
    use Sluggable;
    use Datetime;

    protected $guarded = [];

    public function attachments() {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function medias() {
        return $this->morphMany(Media::class, 'mediable');
    }

    public static function draft() {
        return self::firstOrCreate(['title' => ''], ['slug' => null], ['content' => null]);
    }

    public function getImageDir() {
        return 'storage/uploads/posts/'.ceil($this->id / 1000);
    }
}
