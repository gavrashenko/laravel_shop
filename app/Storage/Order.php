<?php

namespace App\Storage;

use Illuminate\Support\Facades\DB;

class Order
{
    const TABLE = 'order';

    public function saveOrder($data)
    {
        $idOrder = null;
        DB::transaction(function () use ($data, &$idOrder) {
            $form = $data['form'];
            $idOrder = DB::table(self::TABLE)->insertGetId([
                'user_name' => $form['user_name'],
                'user_email' => $form['user_email'],
                'user_phone' => $form['user_phone'],
                'delivery_type' => $form['delivery_type'],
                'delivery_city' => $form['delivery_city'] ? $form['delivery_city'] : '',
                'delivery_address' => $form['delivery_address'] ? $form['delivery_address'] : '',
                'delivery_comment' => $form['delivery_comment'] ? $form['delivery_comment'] : '',
                'payment_type' => $form['payment_type'],
                'hash' => md5(mt_rand()),
            ]);

            foreach ($data['items'] as $item) {
                DB::table('item_order')->insert([
                    'id_item' => (int)$item['id'],
                    'id_order' => $idOrder,
                    'count' => (int)$item['count'],
                    'price' => (int)$item['item']['price'],
                ]);
            }
        });

        $order = $this->getOrderById($idOrder);
        if ($order === null) {
            return null;
        }

        return $order;
    }

    public function getOrderById($idOrder)
    {
        return DB::table(self::TABLE)
            ->select('*')
            ->where('id', '=', $idOrder)
            ->first();
    }

    public function getOrderByIdHash($idOrder, $hash)
    {
        return DB::table(self::TABLE)
            ->select('*')
            ->where([
                ['id', '=', $idOrder],
                ['hash', '=', $hash],
            ])
            ->first();
    }
}