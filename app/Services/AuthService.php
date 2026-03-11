<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject; 
use App\Repositories\Interfaces\UserRepositoryInterface;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = $this->userRepository->create($data);

        //$user->assignRole($data['role'] ?? 'admin');

        $token = auth('api')->login($user);

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function login(array $credentials)
    {
        $token = auth('api')->attempt($credentials);

        if (!$token) {
            return null;
        }

        $user = auth('api')->user();

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}
