<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Services\AuthorService;
use Illuminate\Http\JsonResponse;
use App\Models\Author;

class AuthorController extends Controller
{
    protected AuthorService $authorService;
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }
    public function index(): JsonResponse
    {
        $authors = $this->authorService->getAllAuthors();

        return AuthorResource::collection($authors)->response()->setStatusCode(200);
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
