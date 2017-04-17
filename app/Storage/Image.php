<?php

namespace App\Storage;

use Illuminate\Support\Facades\DB;

class Image
{
    public function getImagesByItemId($idItem) {
        $sql = <<<SQL
            SELECT i.id, i.url, ii.is_primary
            FROM image i, item_image ii
            WHERE i.id = ii.id_image 
                AND ii.id_item = :id_item
SQL;

        return DB::select($sql, [
            'id_item' => (int)$idItem,
        ]);
    }
}