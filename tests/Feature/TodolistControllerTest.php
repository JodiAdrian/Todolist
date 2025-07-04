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

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "jodi",
        ])->post('/todolist', [])
            ->assertSee("Todolist is required!");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "jodi",
        ])->post('/todolist', [
            "todo" => "jodi",
        ])->assertRedirect('/todolist');
    }

    public function testRemoveTodolist()
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
        ])->post('/todolist/1/delete')
            ->assertRedirect('/todolist');
    }
}
