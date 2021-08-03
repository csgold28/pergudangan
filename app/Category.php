<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['name','slug','parent_id'];
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d M Y H:i');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeGetParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function child()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
