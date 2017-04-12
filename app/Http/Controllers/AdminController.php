<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('layouts.admin');
    }

    public function item(Request $request)
    {
        $result = $request->session()->all();
        $token = $result['_token'];

        return view('admin.item', [
            'token' => $token,
        ]);
    }

    public function addItem(Request $request)
    {
        echo '<pre>';
        print_r($_FILES);

        print_r($request->request->all());

        $form = $request->request->all();
        $sql = <<<SQL
          INSERT INTO item (name, alias, description, price, `count`, id_catalogue) 
          VALUES (:name, :alias, :description, :price, :count, :id_catalogue)
SQL;

        DB::insert($sql, [
            'name' => $form['name'],
            'alias' => $form['alias'],
            'description' => $form['description'],
            'price' => $form['price'],
            'count' => $form['count'],
            'id_catalogue' => $form['id_catalogue'],
        ]);

        $idItem = DB::getPdo()->lastInsertId();
        $alias = $form['alias'] . '-' . $idItem;

        DB::update('UPDATE item SET alias = :alias WHERE id = :id', [
            'alias' => $alias,
            'id' => $idItem,
        ]);

        if (!$idItem) {
            echo "ОЙ, что-то пошло не так! :(";
            exit;
        }

        $files = $_FILES;
        $imagesPath = public_path() . '/images/items/' . $alias . '/';
        mkdir($imagesPath);
        move_uploaded_file(
            $files['main_photo']['tmp_name'],
            $imagesPath . $files['main_photo']['name']
        );

        $this->insertImage(
            $alias . '/' . $files['main_photo']['name'],
            $idItem,
            1
        );

        if (!empty($files['photos'])) {
            for ($i = 0, $l = count($files['photos']['name']) ; $i < $l ; $i++) {
                move_uploaded_file(
                    $files['photos']['tmp_name'][$i],
                    $imagesPath . $files['photos']['name'][$i]
                );
                $this->insertImage(
                    $alias . '/' . $files['photos']['name'][$i],
                    $idItem
                );
            }
        }

        return redirect()->action('AdminController@item');
    }

    /**
     * @param $url
     * @param $idItem
     * @param int $isPrimary
     */
    protected function insertImage($url, $idItem, $isPrimary = 0)
    {
        DB::insert("INSERT INTO image (url) VALUES (:url)", [
            'url' => $url,
        ]);
        $idImage = DB::getPdo()->lastInsertId();
        DB::insert("INSERT INTO item_image (id_item, id_image, is_primary) 
                    VALUES (:id_item,:id_image,:is_primary)", [
            'id_item' => $idItem,
            'id_image' => $idImage,
            'is_primary' => $isPrimary,
        ]);
    }
}