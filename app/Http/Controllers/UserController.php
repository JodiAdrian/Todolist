<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function login(): Response
    {
        return response()
            ->view("user.login", [
                    "title" => "Login"
                ]);
    }

    public function dologin(Request $request): Response | RedirectResponse
    {
        $user = $request->input(['user']);
        $password = $request->input(['password']);

        //validate input the data empty or not
        if (empty($user) || empty($password)) {
            return response()->view("user.login", [
                "title" => "Login",
                "error" => "User or password is required"
            ]);
        }

        if ($this->userService->login($user, $password)) {
            $request->session()->put("user", $user);
            return redirect("/");
        }

        return response()->view("user.login", [
            "title" => "Login",
            "error" => "Wrong user or password"
        ]);
    }

    public function logout()
    {

    }
}
