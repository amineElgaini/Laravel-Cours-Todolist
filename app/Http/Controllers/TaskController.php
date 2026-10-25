<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    // Show all tasks of the logged-in user (with filters)
    public function index(Request $request)
    {
        $user = $request->user();

        $query = $user->tasks()->with('category')->latest();

        if ($request->status === 'completed') {
            $query->where('is_completed', true);
        } elseif ($request->status === 'pending') {
            $query->where('is_completed', false);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $tasks = $query->get();
        $categories = Category::orderBy('name')->get();

        $stats = [
            'total' => $user->tasks()->count(),
            'completed' => $user->tasks()->where('is_completed', true)->count(),
        ];
        $stats['pending'] = $stats['total'] - $stats['completed'];

        return view('tasks.index', compact('tasks', 'categories', 'stats'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = Arr::except($this->validated($request), 'attachment');

        try {
            if ($request->hasFile('attachment')) {
                $data['attachment'] = $request->file('attachment')->store('attachments');
            }

            $request->user()->tasks()->create($data);
        } catch (\Throwable $e) {
            report($e);

            return back()->withInput()
                ->with('error', 'Could not save the task. Please try again.');
        }

        return redirect()->route('tasks.index')->with('success', 'Task created!');
    }

    public function show(Task $task)
    {
        $task->load('category');

        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $categories = Category::orderBy('name')->get();

        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        $data = Arr::except($this->validated($request), 'attachment');

        if ($request->hasFile('attachment')) {
            // Remove the old file, then save the new one
            if ($task->attachment) {
                Storage::delete($task->attachment);
            }
            $data['attachment'] = $request->file('attachment')->store('attachments');
        }

        $task->update($data);

        return redirect()->route('tasks.show', $task)->with('success', 'Task updated!');
    }

    public function destroy(Task $task)
    {
        if ($task->attachment) {
            Storage::delete($task->attachment);
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted.');
    }

    // Mark as done / not done
    public function toggle(Task $task)
    {
        $task->update(['is_completed' => ! $task->is_completed]);

        return back()->with('success', $task->is_completed ? 'Task completed!' : 'Task marked as pending.');
    }

    public function attachment(Task $task)
    {
        abort_unless($task->attachment && Storage::exists($task->attachment), 404);

        return Storage::download($task->attachment);
    }

    // Same rules for create and update
    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'due_date' => ['nullable', 'date'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,docx', 'max:2048'],
        ], [
            'title.required' => 'Please write a title for your task.',
            'title.max' => 'The title is too long (255 characters max).',
            'due_date.date' => 'This is not a valid date.',
            'attachment.mimes' => 'Allowed files: pdf, jpg, png, docx.',
            'attachment.max' => 'The file must be 2 MB or less.',
        ]);
    }
}
