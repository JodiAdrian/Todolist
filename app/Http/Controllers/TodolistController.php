<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todolist()
    {
        $todolist = $this->todolistService->getTodolist();
        return response()->view("todolist.todolist", [
            "title" => "Todolist",
            "todolist" => $todolist
        ]);
    }

    public function addTodo(Request $request)
    {
        $todo = $request->input("todo");

        if(empty($todo)) {
            $todolist = $this->todolistService->getTodolist();
           return response()->view("todolist.todolist", [
               "title" => "Todolist",
               "todolist" => $todolist,
               "error" => "Todolist is required!"
           ]);
        }

        $this->todolistService->saveTodo(uniqid(), $todo);

        return redirect()->action([TodolistController::class, 'todolist'])  ;
    }

    public function removeTodo(Request $request, string $todoid)
    {
        $this->todolistService->removeTodo($todoid);
        return redirect()->action([TodolistController::class, 'todolist']);
    }
}
