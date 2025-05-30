<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
   private TodolistService $todolistService;

   protected function setUp(): void
   {
       parent::setUp();

       $this->todolistService = $this->app(TodolistService::class);
   }

   public function testTodolistServiceNotNull()
   {
       self::assertNotNull($this->todolistService);
   }

   public function testsaveTodo()
   {
       $this->todolistService->saveTodo("1", "jodi");

       $todolist = Session::get("todolist");
       foreach ($todolist as $value) {
           self::assertEquals("1", $value['id']);
           self::assertEquals("jodi", $value['todo']);
       }
   }

   public function testgetTodolistEmpty()
   {
       self::assertEmpty($this->todolistService->getTodolist());
   }

   public function testgetTodolistNotEmpty()
   {
       $expected = [
           [
           "id" => 1,
           "todo" => "jodi",
           ],
           [
           "id" => 2,
           "todo" => "Adrian"
            ]
       ];

       $this->todolistService->saveTodo("1", "jodi");
       $this->todolistService->saveTodo("2", "Adrian");

       self::assertEquals($expected, $this->todolistService->getTodolist());
   }

   public function testRemoveTodo()
   {
       $this->todolistService->saveTodo("1", "jodi");
       $this->todolistService->saveTodo("2", "Adrian");

       self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

       $this->todolistService->removeTodo("3");

       self::assertEquals(2, sizeof($this->todolistService->getTodolist()));

       $this->todolistService->removeTodo("1");

       self::assertEquals(1, sizeof($this->todolistService->getTodolist()));

       $this->todolistService->removeTodo("2");

       self::assertEquals(0, sizeof($this->todolistService->getTodolist()));
   }
}
