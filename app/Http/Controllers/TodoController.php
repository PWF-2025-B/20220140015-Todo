<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('user_id', auth()->user()->id)
            ->orderBy('is_complete', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        $todosCompleted = Todo::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->count();

        return view('todo.index', compact('todos', 'todosCompleted'));
    }

    public function create()
    {
        return view('todo.create');
    }

    public function edit(Todo $todo)
    {
        $this->authorizeUser($todo);
        return view('todo.edit', compact('todo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        Todo::create([
            'title' => ucfirst($request->title),
            'user_id' => auth()->user()->id,
            'is_complete' => false,
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo created successfully!');
    }

    public function complete(Todo $todo)
    {
        $this->authorizeUser($todo);
        $todo->update(['is_complete' => true]);
        return redirect()->route('todo.index')->with('success', 'Todo completed successfully!');
    }

    public function uncomplete(Todo $todo)
    {
        $this->authorizeUser($todo);
        $todo->update(['is_complete' => false]);
        return redirect()->route('todo.index')->with('success', 'Todo uncompleted successfully!');
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        $todo->update([
            'title' => ucfirst($request->title),
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo updated successfully!');
    }

    public function destroy(Todo $todo)
    {
        $this->authorizeUser($todo);
        $todo->delete();
        return redirect()->route('todo.index')->with('success', 'Todo deleted successfully!');
    }

    public function destroyCompleted()
    {
        $todosCompleted = Todo::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->get();

        foreach ($todosCompleted as $todo) {
            $todo->delete();
        }

        return redirect()->route('todo.index')->with('success', 'All completed todos deleted successfully!');
    }

    private function authorizeUser(Todo $todo)
    {
        if (auth()->id() !== $todo->user_id) {
            abort(403, 'Unauthorized action.');
        }
    }
}