<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showOrder(Request $request)
    {
        return view('order.order', [
            'templateData' => [
            ]
        ]);
    }

    public function showPersonalOrder($code)
    {
        list($idOrder, $hash) = explode('-', $code);

        if ($idOrder === null
            || $hash === null
            || strlen($hash) !== 32
        ) {
            return response()->json([
                'error' => 'Такой страницы нету :(',
            ], 404);
        } else {
            $order = resolve('storage.order')->getOrderByIdHash((int)$idOrder, $hash);
            if ($order === null) {
                return response()->json([
                    'error' => 'Такой заказ не найден!',
                ], 400);
            } else {
                $items = resolve('storage.item')->getItemsByOrderId($order->id);

                return view('order.personal-order', [
                    'templateData' => [
                        'order' => $order,
                        'items' => $items,
                    ]
                ]);
            }
        }
    }

    public function makeOrder(Request $request)
    {
        $data = $request->all();
        $order = resolve('storage.order')->saveOrder($data);

        if ($order === null) {
            return response()->json([
                'error' => 'Произошла ошибка во время создания заказа, обновите страницу и попробуйте еще раз.',
            ], 400);
        } else {
            return response()->json([
                'idOrder' => $order->id,
                'hash' => $order->hash,
            ]);
        }
    }
}