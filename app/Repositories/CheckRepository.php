<?php

namespace App\Repositories;

use App\Models\Check;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class CheckRepository
{
    public function all(?string $userId = null)
    {
        $checks = ($userId) ? Check::where('user_id', $userId)->get() : Check::all();

        $store = Storage::disk('local');

        foreach ($checks as $check) {
            $fileContent = $store->get($check->picture);

            if ($fileContent !== false) {
                $check->picture = base64_encode($fileContent);
            }
        }

        return $checks;
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
