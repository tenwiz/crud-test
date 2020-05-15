<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;

class UsersController extends Controller
{
    public function index()
    {
        return response(User::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function create(Generator $faker)
    {
        $user = new User();
        $user->name = $faker->name;
        $user->email = $faker->email;
        $user->password = $faker->password;
        $user->save();

        return response($user->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->email = $request->email;
        $user->save();

        return response(null, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        User::destroy($id);

        return response(null, Response::HTTP_OK);
    }
}
