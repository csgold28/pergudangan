<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','name'];
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d M Y H:i');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productdetail()
    {
        return $this->hasMany(Productdetail::class);
    }

    public function projectbarang()
    {
        return $this->hasMany(Projectbarang::class);
    }
}
