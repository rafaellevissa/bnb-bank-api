<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Check extends Model
{
    use HasFactory;

    protected $table = 'checks';

    protected $guard = ['id'];

    protected $fillable = [
        'user_id',
        'amount',
        'description',
        'picture',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPictureBase64Content()
    {
        $store = Storage::disk('local');
        $fileContent = $store->get($this->picture);
        if ($fileContent !== false) {
            return base64_encode($fileContent);
        }

        return null;
    }
}
