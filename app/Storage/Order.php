<?php

namespace App\Storage;

use Illuminate\Support\Facades\DB;

class Order
{
    const TABLE = 'order';

    public function saveOrder($data)
    {
        $idInsert = null;
        DB::transaction(function () use ($data, &$idInsert) {
            $form = $data['form'];
            $idInsert = DB::table(self::TABLE)->insertGetId([
                'user_name' => $form['user_name'],
                'user_email' => $form['user_email'],
                'user_phone' => $form['user_phone'],
                'delivery_type' => $form['delivery_type'],
                'delivery_city' => $form['delivery_city'] ? $form['delivery_city'] : '',
                'delivery_address' => $form['delivery_address'] ? $form['delivery_address'] : '',
                'delivery_comment' => $form['delivery_comment'] ? $form['delivery_comment'] : '',
                'payment_type' => $form['payment_type'],
                'hash' => mt_rand(50, 50),
            ]);

            foreach ($data['items'] as $item) {
                DB::table('item_order')->insert([
                    'id_item' => (int)$item['id'],
                    'id_order' => $idInsert,
                    'count' => (int)$item['count'],
                ]);
            }
        });

        return $idInsert;
    }
}