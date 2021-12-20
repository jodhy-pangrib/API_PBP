<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';

    protected $fillable = [
        'nama', 'room_type', 'checkIn', 'checkOut', 'total_harga'
    ];

    public function getCheckInAttribute() {
        if(!is_null($this->attributes['checkIn'])) {
            return Carbon::parse($this->attributes['checkIn'])->format('Y-m-d H:i:s');
        }
    } // convert format checkIn menjadi Y-m-d

    public function getCheckOutAttribute() {
        if(!is_null($this->attributes['checkOut'])) {
            return Carbon::parse($this->attributes['checkOut'])->format('Y-m-d H:i:s');
        }
    } // convert format checkOut menjadi Y-m-d

    public function getCreatedAtAttribute() {
        if(!is_null($this->attributes['created_at'])) {
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    } // convert format created_at menjadi Y-m-d H:i:s

    public function getUpdatedAtAttribute() {
        if(!is_null($this->attributes['updated_at'])) {
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    } // convert format updated_at menjadi Y-m-d H:i:s
}
