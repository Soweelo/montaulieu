<?php

namespace App\Behaviour;
use Carbon\Carbon;
trait Datetime
{
    public function getCreatedAtAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i');
    }
    public function getUpdatedAtAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d/m/Y H:i');
    }
}
