<?php

namespace App\Storage;

use Illuminate\Support\Facades\DB;

class Item
{
    const TABLE = 'item';

    public function getItemById($idItem)
    {
        return DB::table(self::TABLE)
            ->select('*')
            ->where('id', '=', (int)$idItem)
            ->first();
    }

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

    public function getItemsByOrderId($idOrder)
    {
        $items = DB::table(self::TABLE)
            ->selectRaw('item.*, catalogue.alias catalogue_alias, item_order.count order_count, item_order.price order_price')
            ->join('catalogue', 'item.id_catalogue', '=', 'catalogue.id')
            ->join('item_order', 'item_order.id_item', '=', 'item.id')
            ->where('item_order.id_order', '=', (int)$idOrder)
            ->orderBy('item.id', 'asc')
            ->get();

        if (!$items) {
            return [];
        }

        $itemIds = [];
        foreach ($items as $it) {
            $itemIds[] = $it->id;
        }

        $images = $this->getItemMainImages($itemIds);
        foreach ($items as &$item) {
            if (isset($images[$item->id])) {
                $item->main_image = $images[$item->id];
            } else {
                $item->main_image = null;
            }
        }

        return $items;
    }

    public function getItemsByCatalogueAlias($catalogueAlias)
    {
        $items = DB::table(self::TABLE)
            ->selectRaw('item.*, catalogue.alias catalogue_alias')
            ->join('catalogue', 'item.id_catalogue', '=', 'catalogue.id')
            ->where('catalogue.alias', '=', $catalogueAlias)
            ->orderBy('item.id', 'desc')
            ->get();

        if (!$items) {
            return [];
        }

        $itemIds = [];
        foreach ($items as $it) {
            $itemIds[] = $it->id;
        }

        $images = $this->getItemMainImages($itemIds);
        foreach ($items as &$item) {
            if (isset($images[$item->id])) {
                $item->main_image = $images[$item->id];
            } else {
                $item->main_image = null;
            }
        }

        return $items;
    }
}