<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function verifyData(Request $request): JsonResponse
    {

        $email = User::where('email', '=', $request['email'])->first();

        if (!empty($email)) {
            $response = [
                'Code' => '400',
                'Type' => 'Error',
                'Message' => 'Email Já Cadastrado ou Dados inválidos!',
                'Data' => null
            ];
            return new JsonResponse($response, 400);
        }
        $response = [
            'Code' => '200',
            'Type' => 'Success',
            'Message' => 'Email Disponível!',
            'Data' => []
        ];

        return new JsonResponse($response, 200);
    }

    public function createUser(Request $request): JsonResponse
    {
        $user = new User();

        $user->email = $request->email;
        $user->password = $request->password;
        $user->name = $request->name;

        try {
            $user->save();
        } catch (\Exception $th) {
            $response = [
                'Code' => '400',
                'Type' => 'Error',
                'Message' => $th->getMessage(),
                'Data' => null
            ];

            return new JsonResponse($response, 400);
        }

        $response = [
            'Code' => '200',
            'Type' => 'Success',
            'Message' => 'Usuário Cadastrado com Sucesso!',
            'Data' => $user
        ];

        return new JsonResponse($response, 200);
    }

    public function login(Request $request): JsonResponse
    {
        $userLogin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $result = User::where([
            ['email', '=', $userLogin['email']],
            ['password', '=', $userLogin['password']]
        ])->get();

        if ($result->count()>0) {
            $response = [
                'Code' => '200',
                'Type' => 'Success',
                'Message' => 'Você Foi Logado Com Sucesso!',
                'Data' => $result
            ];
    
            return new JsonResponse($response, 200);
        }else {

            $response = [
                'Code' => '400',
                'Type' => 'Error',
                'Message' => 'Dados Inválidos',
                'Data' => null
            ];

            return new JsonResponse($response, 400);
        }

    }
}
