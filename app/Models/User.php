<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    use HasUuids;

    protected $table = 'users';

    protected $primaryKey = 'uuid';

    public $incrementing = false;

    protected $fillable = ['name', 'email', 'cpf', 'profile_uuid'];

    public function addresses()
    {
        return $this->belongsToMany(Addresses::class, 'address_users', 'user_uuid', 'address_uuid');
    }
    public function profile()
    {
        return $this->belongsTo(Profiles::class, 'profile_uuid', 'uuid');
    }
}
