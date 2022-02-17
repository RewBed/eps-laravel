<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class PaymentController extends Controller
{

    /**
     * Создание оплаты
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request) : JsonResponse {
        $validated = $request->validate([
            'projectID' => ['required', 'integer'],
            'billID' => ['required', 'integer'],
            'sumVal' => ['required', 'integer'],
            'payDate' => ['required'],
            'statusID' => ['required', 'integer']
        ]);

        $payment = new Payment();
        $payment->fill($validated);

        if($payment->save())
            return response()->json(['payment' => $payment]);

        return response()->json(['error' => '']);
    }

    /**
     * Обновление оплаты
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'id' => ['required', 'integer'],
        ]);

        $payment = Payment::findOrFail($validated['id']);
        $payment->fill($validated);
        $payment->save();

        return response()->json(['payment' => $payment]);
    }

    /**
     * Удалить оплату
     *
     * @param int $projectID
     * @return JsonResponse
     */
    public function delete(int $projectID): JsonResponse
    {
        $payment = Payment::findOrFail($projectID);
        return response()->json(['delete' => $payment->delete()]);
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
}
