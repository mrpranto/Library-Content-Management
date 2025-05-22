<?php

namespace App\Http\Controllers;

use App\Http\Requests\PagesRequest;
use App\Http\Resources\PagesResources;
use App\Models\Chapter;
use App\Models\Page;
use App\Services\PagesService;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    public function __construct(PagesService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $pages = $this->service->getPages();

            return PagesResources::collection($pages);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PagesRequest $request): JsonResponse
    {
        try {

            $page = $this->service
                ->setAttrs($request->validated())
                ->save();

            return createSuccessResponse('Page', $page);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page): PagesResources
    {
        return new PagesResources($page->load('chapter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PagesRequest $request, Page $page): JsonResponse
    {
        try {

            $page = $this->service
                ->setModel($page)
                ->setAttrs($request->validated())
                ->save();

            return updateSuccessResponse('Page', $page);

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page): JsonResponse
    {
        try {

            $page->delete();

            return deleteSuccessResponse('Page');

        }catch (\Exception $e) {
            return customErrorResponse($e, $e->getCode());
        }
    }
}
