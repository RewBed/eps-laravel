<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Request as RequestItem;

class RequestController extends Controller
{
    /**
     * Количество счетов на странице
     *
     * @var int
     */
    private int $requestOnPage = 15;

    /**
     * Создание заявки
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request) : JsonResponse {
        $validated = $request->validate([
            'name' => ['required', 'filled', 'max:255'],
            'projectID' => ['required', 'integer']
        ]);

        $rq = new RequestItem();
        $rq->fill($validated);

        if($rq->save())
            return response()->json(['request' => $rq]);

        return response()->json(['error' => '']);
    }

    /**
     * Обновление заявки
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer'],
            'name' => ['filled', 'max:255'],
            'projectID' => ['integer']
        ]);

        $rq = RequestItem::findOrFail($validated['id']);
        $rq->fill($validated);
        $rq->save();

        return response()->json(['request' => $rq]);
    }

    /**
     * Удалить заявку
     *
     * @param int $requestID
     * @return JsonResponse
     */
    public function delete(int $requestID): JsonResponse
    {
        $rq = RequestItem::findOrFail($requestID);
        return response()->json(['delete' => $rq->delete()]);
    }

    /**
     * Экземпляр заявки
     *
     * @param int $rqID
     * @return JsonResponse
     */
    public function item(int $rqID) : JsonResponse {
        return response()->json(['request' => RequestItem::findOrFail($rqID)]);
    }

    /**
     * Список счетов
     *
     * @return JsonResponse
     */
    public function list() : JsonResponse {
        $rq = RequestItem::leftJoin('projects', 'requests.projectID', '=', 'projects.id')
            ->paginate($this->requestOnPage, ['projects.name as projectName', 'requests.*', 'projects.id as projectID']);
        return response()->json(['requests' => $rq]);
    }

    /**
     * Список счетов по проекту
     *
     * @param int $projectID
     * @return JsonResponse
     */
    public function listByProject(int $projectID) : JsonResponse {
        $rq = RequestItem::where('projectID', $projectID)
            ->leftJoin('projects', 'requests.projectID', '=', 'projects.id')
            ->paginate($this->requestOnPage, ['projects.name as projectName', 'requests.*', 'projects.id as projectID']);
        return response()->json(['requests' => $rq]);
    }
}
