<?php

namespace App\Http\Controllers\User;

use App\Domains\User\Actions\Profile\UpdatePasswordUserAction;
use App\Domains\User\Actions\Profile\UpdateUserAction;
use App\Domains\User\DataTransferObjects\UpdatePasswordUserData;
use App\Domains\User\DataTransferObjects\UpdateUserData;
use App\Domains\User\Resources\ProfileResource;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function show()
    {
        return response()->json(new ProfileResource(auth()->user()));
    }

    public function update(UpdateUserData $data)
    {
        return response()->json([
            'message' => 'Данные успешно обновлены!',
            'user' => new ProfileResource(UpdateUserAction::execute($data))
        ]);
    }

    public function updatePassword(UpdatePasswordUserData $data)
    {
        UpdatePasswordUserAction::execute($data);
        return response()->json([
            "message" => "Пароль успешно обновлен!",
        ]);
    }

    public function resetPassword()
    {

    }


}
