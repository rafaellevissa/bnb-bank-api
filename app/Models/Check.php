<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;

    protected $table = 'checks';

    protected $guard = ['id'];

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
