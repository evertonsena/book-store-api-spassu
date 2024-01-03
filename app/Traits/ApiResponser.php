<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
 */

const RESPONSE_OK = Response::HTTP_OK;
const RESPONSE_CREATED = Response::HTTP_CREATED;
const RESPONSE_BAD_REQUEST = Response::HTTP_BAD_REQUEST;
const RESPONSE_NOT_FOUND = Response::HTTP_NOT_FOUND;
const RESPONSE_UNAUTHORIZED = Response::HTTP_UNAUTHORIZED;
const RESPONSE_NOT_ACCEPTABLE = Response::HTTP_NOT_ACCEPTABLE;
const RESPONSE_NO_CONTENT = Response::HTTP_NO_CONTENT;

trait ApiResponser
{

    /**
     * Return a success JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data, string $message = null, int $code = RESPONSE_OK)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Return an alert JSON response.
     *
     * @param  array|string  $data
     * @param  string  $message
     * @param  int|null  $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function alert($data, int $code = RESPONSE_NOT_ACCEPTABLE, string $message = null)
    {
        return response()->json([
            'status' => 'alert',
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Return an error JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error(string $message = null, int $code = RESPONSE_BAD_REQUEST, $data = null)
    {
        if (Str::isJson($message)) {
            $message = json_decode($message);
        }

        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $data,
        ], $code);
    }


    /**
     * Return a no content JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function no_content()
    {
        return response()->json(null, RESPONSE_NO_CONTENT);
    }


    /**
     * Return for delete record JSON response.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  array|string|null  $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function deleted()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Registro deletado com sucesso'
        ], 200);
    }
}
