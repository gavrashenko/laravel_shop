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

}