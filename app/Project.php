<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['client_id','user_id','nominal','dp','sisa','waktu_sewa','tipe_transaksi','no_kontrak','status_pembayaran','keterangan_pembayaran','status_barang','teknisiloading_id','teknisibongkar_id','note'];
    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d M Y H:i');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projectbarang()
    {
        return $this->hasMany(Projectbarang::class);
    }
}
