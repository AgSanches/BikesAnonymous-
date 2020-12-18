<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements BaseRepository
{

    public function fetchAdmin() {
        return User::query()->where('role', '=', 1)->first();
    }

    public function getAuthenticatedUser() {
        return Auth::guard()->user();
    }

    public function create($data)
    {
        // TODO: Implement create() method.
    }
}
