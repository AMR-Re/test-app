<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\TodoService;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {

        $this->todoService = $todoService;
    }

    public function index()
    {
        $todos = $this->todoService->getAllTodos();
        return response()->json($todos);
    }

    public function show($id)
    {
        $todo = $this->todoService->getTodo($id);
        return response()->json($todo);
    }

    public function store(Request $request)
    {
        
        $todo = $this->todoService->createTodo($request);
        return response()->json($todo, 201);
    }

    public function update(Request $request, $id)
    {
       

        $todo = $this->todoService->updateTodo($request,$id);
        return response()->json($todo);
    }

    public function destroy($id)
    {
        $result = $this->todoService->deleteTodo($id);
        return response()->json(['success' => $result]);
    }
}