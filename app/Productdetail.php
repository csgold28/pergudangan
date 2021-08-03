<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productdetail extends Model
{
    protected $fillable = ['product_id','barcode','serial_number','status', 'status_barang','suplayer_id','keterangan','project_id'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function suplayer()
    {
        return $this->belongsTo(Suplayer::class);
    }
}
