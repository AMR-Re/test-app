<?php

namespace App\Services;
use GuzzleHttp\Client;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoService
{
    protected $client;
    protected $baseUrl = 'https://jsonplaceholder.typicode.com';

    public function __construct()
    {
        $this->client = new Client(['base_uri' => $this->baseUrl ,'verify' => false]);//use verify false to escape cUrl 60 error not suitable in production just for test purposes
    }

    public function getAllTodos()
    {
      $response = $this->client->get('/todos');
    
      if ($response->getStatusCode() !== 200) {
        return response()->json(['message' => 'Failed to retrieve TODOs from API'], 500);
      }
    
      $todosData = json_decode($response->getBody(), true);
      $todos = [];
    
      // Loop through retrieved data and create Todo objects
      foreach ($todosData as $todoItem) {
        $todos[] = new Todo([
          'title' => $todoItem['title'],
    
          'completed' => $todoItem['completed'],
        ]);
      }
    
     
      return $todos; 
    }
    
   

    

    public function getTodo($id)
    {
        $response = $this->client->get("/todos/{$id}");
        return json_decode($response->getBody(), true);
    }

    public function createTodo(Request $request)
    {
    
  $data = $request->validate([
    'title' => 'required|string',

    'completed' => 'boolean',
  ]);

  $todo = Todo::create($data);

  return response()->json(['message' => 'TODO successfully created', 'data' => $todo], 201);
    }

    public function updateTodo(Request $request, $id)
{
    
    $todo = Todo::find($id);

    if (!$todo) {
        return response()->json(['message' => 'TODO not found'], 404);
    }

   
    $todo->title = $request->get('title'); 
    $todo->completed = $request->get('completed'); 

   

    $todo->save(); 

    return response()->json(['message' => 'TODO successfully updated'], 200);
}

    public function deleteTodo($id)
    {
        $response = $this->client->delete("/todos/{$id}");

        if ($response->getStatusCode() !== 200) {
          return response()->json(['message' => 'Failed to delete TODO at external API'], 422); // Unprocessable Entity
        }
      
        $todo = Todo::find($id);
      
        if (!$todo) {
          return response()->json(['message' => 'TODO not found'], 404); // Not Found
        }
      
        $todo->delete();
      
        return response()->json(['message' => 'TODO successfully deleted'], 200);
    }
}