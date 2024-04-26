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

    public function findOne(string $checkId, ?string $userId = null)
    {
        if ($userId) {
            $check = Check::where('id', $checkId)->where('user_id', $userId)->first();
        } else {
            $check = Check::where('id', $checkId)->first();
        }

        if (!$check) {
            throw new \Exception("Check not found");
        }

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
