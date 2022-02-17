<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\JsonResponse;

class InfoController extends Controller
{

    /**
     * Вывести список статусов
     *
     * @return JsonResponse
     */
    public function list() : JsonResponse
    {
        return response()->json([
            'statuses' => [
                'project' => Status::where('type', 1)->get(),
                'billGood' => Status::where('type', 2)->get(),
                'requests' => Status::where('type', 3)->get()
            ]
        ]);
    }
}
