<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectbarang extends Model
{
    protected $fillable = ['project_id','product_id','jumlah'];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
