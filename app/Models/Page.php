<?php

namespace App\Models;

use App\Behaviour\Datetime;
use App\Behaviour\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    use Sluggable;
    use Datetime;

    protected $guarded = [];

    public function attachments() {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public static function draft() {
        return self::firstOrCreate(['title' => ''], ['slug' => null], ['content' => null]);
    }
}
