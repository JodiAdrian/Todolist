<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
       $this->get('/login')
           ->assertStatus("login");
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "jodi"
        ])->get('/login')
            ->assertRedirect("/");
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "jodi",
            "password" => "rahasia"
        ])->assertRedirect('/')
            ->assertSessionHas("user", "jodi");
    }

    public function testLoginForUseAlreadyLoggedIn()
    {
        $this->withSession([
            "user" => "jodi",
        ])->post('/login', [
            "user" => "jodi",
            "password" => "rahasia"
        ])->assertRedirect("/");
    }

    public function testLoginValidationFail()
    {
        $this->post('/login', [])
            ->assertSeeText("User or password is required");
    }

    public function testLoginFailed()
    {
        $this->post('/login', [
            'user' => "wrong",
            "password" => "wrong"
        ])->assertSeeText("Wrong user or password");
    }

    public function testLogoutSuccess()
    {
        $this->withSession([
            'user' => 'jodi'
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing("user");
    }
}
