<?php

use Illuminate\Http\JsonResponse;

/**
 * @param $name
 * @param $data
 * @return JsonResponse
 */
function createSuccessResponse($name, $data = null): JsonResponse
{
    return response()->json([
        'success' => true,
        'message' => $name . ' created successfully',
        'data' => $data,
    ], 201);
}
/**
 * @param $name
 * @param $data
 * @return JsonResponse
 */
function updateSuccessResponse($name, $data = null): JsonResponse
{
    return response()->json([
        'success' => true,
        'message' => $name.' update successfully',
        'data' => $data,
    ], 200);
}

/**
 * @param $name
 * @return JsonResponse
 */
function deleteSuccessResponse($name): JsonResponse
{
    return response()->json([
        'success' => true,
        'message' => $name.' delete successfully',
        'data' => [],
    ], 200);
}

/**
 * @param $message
 * @return JsonResponse
 */
function customSuccessResponse($message): JsonResponse
{
    return response()->json([
        'success' => true,
        'message' => $message,
        'data' => [],
    ], 200);
}

/**
 * @param $error
 * @param $code
 * @return JsonResponse
 */
function customErrorResponse($error, $code = 500): JsonResponse
{
    return response()->json([
        'success' => false,
        'message' => $error->getMessage(),
        'data' => $error,
    ], $code);
}
