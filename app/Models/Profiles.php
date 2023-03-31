<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profiles extends Model
{
    use HasFactory;

    use HasUuids;

    public $timestamps = false;

    protected $fillable = ['name'];

    public $primaryKey = 'uuid';
}
