<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Suplayer extends Model
{
    protected $fillable = ['name'];
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d M Y H:i');
    }

    public function productdetail()
    {
        return $this->hasMany(Productdetail::class);
    }
}
