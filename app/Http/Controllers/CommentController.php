<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    protected CommentService $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
        $this->middleware('auth:api')->except(['index', 'show']);
    }

public function store(CommentRequest $request, Product $product)
{
    Log::info('Store comment hit', [
        'route_product' => $product,
        'request_body' => $request->all(),
    ]);

    $request->validate([
        'body' => 'required|string|max:2000',
    ]);

    $comment = $this->service->store($product, $request->body);

    return response()->json($comment->load('user'), 201);
}

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate(['body' => 'required|string|max:2000']);

        $updated = $this->service->update($comment, $request->body);

        return response()->json($updated);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $this->service->delete($comment);

        return response()->json(['message' => 'Comment deleted']);
    }
}
