<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
}
