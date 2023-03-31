<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    use HasUuids;

    public $timestamps = false;

    public $primaryKey = 'uuid';

    protected $fillable = ['name', 'cep_uuid'];

    public function user() {
        return $this->belongsToMany(User::class, 'address_users', 'address_uuid', 'user_uuid');
        // return $this->belongsToMany(User::class, 'address_user', 'user_uuid', 'uuid');
    }
    public function cep() {
        return $this->belongsTo(Cep::class, 'cep_uuid', 'uuid');
    }
}
