<?php

namespace App\Services\impl;

use App\Services\TodolistService;
use Illuminate\Support\Facades\Session;

class TodolistServiceimpl implements TodolistService
{
    public function saveTodo(string $id, string $todo): void
    {
        if(!Session::exists("todolist")) {
            Session::put("todolist", []);
        }

        Session::push("todolist", [
            "id" => $id,
            "todo" => $todo
        ]);
    }

     public function getTodolist(): array
     {
         return Session::get("todolist", []);
     }

     public function removeTodo(string $todoId)
     {
         // Ambil data todolist dari session, atau [] jika tidak ada
         $todolist = Session::get("todolist");

         foreach ($todolist as $index => $value) {
             if ($value["id"] == $todoId) {
                 unset($todolist[$index]);
                 break;
             }
         }

         // Simpan ulang todolist yang sudah dihapus
         Session::put("todolist", $todolist);
     }
}
