<?php

namespace App\Traits;

use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

trait HttpResponses
{
    public function response(string $message,  int|string $status, array|Model|JsonResource $data = [])
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'status' => $status,
        ], $status);
    }

    public function  error(string $message,  int|string $status, array|MessageBag $errors, array $data = [])
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'status' => $status,
            'errors' => $errors
        ], $status);
    }
}