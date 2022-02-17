<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class BillController extends Controller
{
    /**
     * Количество счетов на странице
     *
     * @var int
     */
    private int $billsOnPage = 15;

    /**
     * Создание счета
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request) : JsonResponse {
        $validated = $request->validate([
            'name' => ['required', 'filled', 'max:255'],
            'projectID' => ['required', 'integer']
        ]);

        $project = new Bill();
        $project->fill($validated);

        if($project->save())
            return response()->json(['bill' => $project]);

        return response()->json(['error' => '']);
    }

    /**
     * Обновление счета
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

        $project = Bill::findOrFail($validated['id']);
        $project->fill($validated);
        $project->save();

        return response()->json(['bill' => $project]);
    }

    /**
     * Удалить счет
     *
     * @param int $projectID
     * @return JsonResponse
     */
    public function delete(int $projectID): JsonResponse
    {
        $project = Bill::findOrFail($projectID);
        return response()->json(['delete' => $project->delete()]);
    }

    /**
     * Экземпляр счета
     *
     * @param int $projectID
     * @return JsonResponse
     */
    public function item(int $projectID) : JsonResponse {
        return response()->json(['bill' => Bill::findOrFail($projectID)]);
    }

    /**
     * Список счетов
     *
     * @return JsonResponse
     */
    public function list() : JsonResponse {
        $projects = Bill::paginate($this->billsOnPage);
        return response()->json(['bills' => $projects]);
    }

    /**
     * Список счетов по проекту
     *
     * @param int $projectID
     * @return JsonResponse
     */
    public function listByProject(int $projectID) : JsonResponse {
        $projects = Bill::where('projectID', $projectID)->paginate($this->billsOnPage);
        return response()->json(['bills' => $projects]);
    }

    /**
     * Список счетов по заявки
     *
     * @param int $requestID
     * @return JsonResponse
     */
    public function listByRequest(int $requestID) : JsonResponse {
        $bills = Bill::where('requestID', $requestID)->paginate($this->billsOnPage);
        return response()->json(['bills' => $bills]);
    }

    /**
     * Список оплат по счету
     *
     * @param int $billID
     * @return JsonResponse
     */
    public function payments(int $billID) : JsonResponse {
        $payments = Payment::where('billID', $billID)->paginate($this->billsOnPage);
        return response()->json(['payments' => $payments]);
    }
}
