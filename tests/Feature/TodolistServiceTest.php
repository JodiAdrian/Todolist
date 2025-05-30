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
}
