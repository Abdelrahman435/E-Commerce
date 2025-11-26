<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Product;

class CommentService
{
    public function store(Product $product, string $body): Comment
    {
        return $product->comments()->create([
            'user_id' => auth()->id(),
            'body' => $body,
        ]);
    }

    public function update(Comment $comment, string $body): Comment
    {
        $comment->update([
            'body' => $body,
        ]);

        return $comment;
    }

    public function delete(Comment $comment): bool
    {
        return $comment->delete();
    }
}
