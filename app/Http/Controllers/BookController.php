<?php

namespace App\Http\Controllers;

use App\Http\Requests\BooksRequest;
use App\Http\Resources\BooksResources;
use App\Models\Book;
use App\Services\BooksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    /**
     * @param BooksService $service
     */
    public function __construct(BooksService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse|AnonymousResourceCollection
    {
        try {

            $books = $this->service->getBooks();

            return BooksResources::collection($books);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BooksRequest $request): JsonResponse
    {
        try {

            $book = $this->service
                ->setAttrs($request->validated())
                ->save();

            return createSuccessResponse('Book', $book);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book): BooksResources
    {
        return new BooksResources($book->load('bookShelf'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BooksRequest $request, Book $book): JsonResponse
    {
        try {

            $book = $this->service
                ->setModel($book)
                ->setAttrs($request->validated())
                ->save();

            return updateSuccessResponse('Book', $book);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book): JsonResponse
    {
        try {

            $book->delete();

            return deleteSuccessResponse('Book');

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }
}
