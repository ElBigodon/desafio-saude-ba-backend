<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressUser extends Model
{
    use HasFactory;

    use HasUuids;

    public $primaryKey = 'uuid';

    protected $fillable = ['user_uuid', 'address_uuid'];

    public $timestamps = false;

    public function addresses() {
        return $this->belongsTo(Addresses::class, 'address_uuid', 'uuid');
    }
    public function users() {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
