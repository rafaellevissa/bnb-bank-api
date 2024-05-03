<?php

namespace App\Repositories;

use App\Models\Check;
use Illuminate\Http\UploadedFile;

class CheckRepository
{
    public function all(?string $userId = null)
    {
        $checks = ($userId) ? Check::where('user_id', $userId)->get() : Check::all();

        return $checks->map(function ($check) {
            $checkArray = $check->toArray();
            $checkArray['pictureBase64'] = $check->getPictureBase64Content();
            return $checkArray;
        });
    }

    public function findByStatus(string $status)
    {
        $checks = Check::where('status', $status)->get();

        return $checks->map(function ($check) {
            $checkArray = $check->toArray();
            $checkArray['pictureBase64'] = $check->getPictureBase64Content();
            return $checkArray;
        });
    }

    public function update(string $checkId, array $payload)
    {
        $check = Check::findOrFail($checkId);

        $check->update($payload);

        return $payload;
    }

    public function findOne(string $checkId, ?string $userId = null, ?string $status = null)
    {
        $query = Check::with('user')->where('id', $checkId);

        if ($userId) {
            $query = $query->where('user_id', $userId);
        }

        if ($status) {
            $query = $query->where('status', $status);
        }

        $check = $query->firstOrFail();

        $result = $check->toArray();
        $result['pictureBase64'] = $check->getPictureBase64Content();

        return $result;
    }

    public function store(string $userId, float $amount, string $description, UploadedFile $picture)
    {
        $picturePath = $picture->store('pictures');

        $check = Check::create([
            'user_id' => $userId,
            'amount' => $amount,
            'description' => $description,
            'picture' => $picturePath,
        ]);

        return $check;
    }
}
