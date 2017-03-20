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

    public function makeOrder(Request $request)
    {
        $data = $request->all();
        $idOrder = resolve('storage.order')->saveOrder($data);

        return response()->json([
            'idOrder' => $idOrder,
        ]);
    }
}