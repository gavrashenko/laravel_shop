<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{
    public function getMainImages(Request $request)
    {
        $idItems = $request->get('idItems');
        $mainImages = resolve('storage.item')->getItemMainImages($idItems);

        return response()->json([
            'mainImages' => $mainImages,
        ]);
    }
}