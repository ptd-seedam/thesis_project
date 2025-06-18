<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {
        $authors = Author::withCount('books')->latest()->paginate(10);

        return response()->json([
            'success' => true,
            'data' => AuthorResource::collection($authors),
            'meta' => [
                'current_page' => $authors->currentPage(),
                'total' => $authors->total(),
            ],
        ]);
    }
    public function show(Author $author): JsonResponse
    {
        $author->load('books');

        return response()->json([
            'success' => true,
            'data' => new AuthorResource($author),
        ]);
    }
}
