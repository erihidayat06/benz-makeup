<?php

namespace App\Models;

use App\Models\User;
use App\Models\Pilihan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['user'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['cari'] ?? false, fn($query,$cari)=>
        $query->where('no_pesanan', 'like', '%' . $cari . '%')->
                orWhere('alamat', 'like', '%' . $cari . '%')->
                orWhere('no_telp', 'like', '%' . $cari . '%')
        );

       $query->when($filters['uniq_user'] ?? false, fn($query, $uniq_user)=>
            $query->whereHas('user', fn($query)=>
            $query->where('uniq', $uniq_user))
        );

        $query->when($filters['cancel']?? false, fn($query, $cancel)=>
            $query->whereHas('user', fn($query)=>
            $query->where('cancel', $cancel))
        );

        $query->when($filters['acc_pesanan']?? false, fn($query, $acc_pesanan)=>
            $query->whereHas('user', fn($query)=>
            $query->where('acc_pesanan', $acc_pesanan))
        );

        
    }

    public function scopeCancel($query)
    {
        $query->when()->where('user_id', auth()->user()->id );
        $query->when()->where('cancel', false);
    }

    public function scopePesananCancel($query)
    {
        $query->when()->where('cancel', 1);
    }

    public function scopePesanan($query)
    {
        $query->when()->where('cancel', false);
    }


    public function scopeTransaksi($query)
    {
        if(isset( auth()->user()->id)){
            $query->when()->where('user_id', auth()->user()->id );
        }
        $query->when()->where('cancel', false);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pilihan()
    {
        return $this->belongsTo(Pilihan::class);
    }
}
