<?php

namespace App\Storage;

use Illuminate\Support\Facades\DB;

class Item
{
    const TABLE = 'item';

    public function getItemByAlias($alias)
    {
        return DB::table(self::TABLE)
            ->select('*')
            ->where('alias', '=', $alias)
            ->first();
    }

    public function getItemMainImages($idItems)
    {
        $ids = [];
        foreach ($idItems as $idItem) {
            $ids[] = (int)$idItem;
        }

        $images = DB::table('image')
            ->select('image.*', 'item_image.id_item')
            ->join('item_image', 'item_image.id_image', '=', 'image.id')
            ->where('item_image.is_primary', '=', 1)
            ->whereIn('item_image.id_item', $ids)
            ->get();

        $res = [];
        foreach ($images as $image) {
            $res[$image->id_item] = $image;
        }

        return $res;
    }

}