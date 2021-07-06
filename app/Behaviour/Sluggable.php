<?php

namespace App\Behaviour;
use Illuminate\Support\Str;

trait Sluggable
{
    public function setSlugAttribute($slug) {
        if (empty($slug) || ($slug == '')) {
            $this->attributes['slug'] = Str::slug($this->title);
        } else {
            $this->attributes['slug'] = $slug;
        }
    }
}
