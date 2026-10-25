<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTaskOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        $task = $request->route('task');

        if ($task instanceof Task && $task->user_id !== $request->user()->id) {
            abort(403, 'This task is not yours.');
        }

        return $next($request);
    }
}
