<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChaptersRequest;
use App\Http\Resources\ChaptersResources;
use App\Models\Chapter;
use App\Services\ChaptersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ChapterController extends Controller
{
    public function __construct(ChaptersService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse|AnonymousResourceCollection
    {
        try {

            $chapters = $this->service->getChapters();

            return ChaptersResources::collection($chapters);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function chapterPageContent(): JsonResponse|AnonymousResourceCollection
    {
        try {

            $chapters = $this->service->getChaptersWithPageContent();

            return ChaptersResources::collection($chapters);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ChaptersRequest $request): JsonResponse
    {
        try {

            $chapter = $this->service
                ->setAttrs($request->validated())
                ->save();

            return createSuccessResponse('Chapter', $chapter);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Chapter $chapter): ChaptersResources
    {
        return new ChaptersResources($chapter->load('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ChaptersRequest $request, Chapter $chapter): JsonResponse
    {
        try {

            $chapter = $this->service
                ->setModel($chapter)
                ->setAttrs($request->validated())
                ->save();

            return updateSuccessResponse('Chapter', $chapter);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chapter $chapter): JsonResponse
    {
        try {

            $chapter->delete();

            return deleteSuccessResponse('Chapter');

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }
}
