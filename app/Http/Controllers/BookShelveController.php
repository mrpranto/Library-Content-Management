<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookshelvesRequest;
use App\Http\Resources\BookshelvesResources;
use App\Models\Bookshelf;
use App\Services\BookshelvesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookShelveController extends Controller
{
    /**
     * @param BookshelvesService $service
     */
    public function __construct(BookshelvesService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse|AnonymousResourceCollection
    {
        try {

            $bookshelves = $this->service->getBookshelves();

            return BookshelvesResources::collection($bookshelves);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookshelvesRequest $request): JsonResponse
    {
        try {

            $bookshelf = $this->service
                ->setAttrs($request->validated())
                ->save();

            return createSuccessResponse('Bookshelf', $bookshelf);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bookshelf $bookshelf): BookshelvesResources
    {
        return new BookshelvesResources($bookshelf);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookshelvesRequest $request, Bookshelf $bookshelf): JsonResponse
    {
        try {

            $bookshelf = $this->service
                ->setModel($bookshelf)
                ->setAttrs($request->validated())
                ->save();

            return updateSuccessResponse('Bookshelf', $bookshelf);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bookshelf $bookshelf): JsonResponse
    {
        try {
            $bookshelf->delete();

            return deleteSuccessResponse('Bookshelf');

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }
}
