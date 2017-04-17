<?php

namespace App\Storage;

use Illuminate\Support\Facades\DB;

class Catalogue
{
    const TABLE = 'catalogue';

    public function getCatalogueByAlias($alias)
    {
        return DB::table(self::TABLE)
            ->select('*')
            ->where('alias', '=', $alias)
            ->first();
    }

    public function getAllCatalogues()
    {
        return DB::table(self::TABLE)
            ->select('*')
            ->get();
    }
}