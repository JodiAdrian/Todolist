<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "jodi",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Jodi"
                ],
                [
                    "id" => "2",
                    "todo" => "Adrian"
                ],
            ]
        ])->get('/todolist')
            ->assertSeeText("1")
            ->assertSeeText("Jodi")
            ->assertSeeText("2")
            ->assertSeeText("Adrian");
    }
}
