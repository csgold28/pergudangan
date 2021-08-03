<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'phone','alamat','foto_ktp','foto_npwp','user_id'];
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d M Y H:i');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
