<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;



class CatalogueController extends Controller
{
    public $mailchimp;

    public function __construct(\Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    public function showAll()
    {
        $cats = DB::select('SELECT * FROM catalogue ORDER BY `order` ASC');
        $items = DB::select('
                        SELECT i.*, c.alias catalogue_alias 
                        FROM item i, catalogue c
                        WHERE c.id = i.id_catalogue
                        ORDER BY i.id DESC 
                        LIMIT 50');
        $sql = <<<SQL
            SELECT i.id, i.url, ii.is_primary
            FROM image i, item_image ii
            WHERE i.id = ii.id_image 
              AND ii.is_primary = 1
              AND ii.id_item = :id_item
SQL;

        foreach ($items as &$item) {
            $images = DB::select($sql, [
                'id_item' => $item->id,
            ]);

            if (!empty($images)) {
                $item->main_image = $images[0];
            }
        }

        return view('catalogue.list', [
            'templateData' => [
                'showSorting' => false,
                'categories' => $cats,
                'items' => $items,
                'categoryName' => 'Недавно добавленные игрушки',
            ]
        ]);
    }

    public function showCatalogue($catalogueAlias)
    {
        $cats = DB::select('SELECT * FROM catalogue ORDER BY `order` ASC');

        $sql = <<<SQL
            SELECT i.id, i.url, ii.is_primary
            FROM image i, item_image ii
            WHERE i.id = ii.id_image 
              AND ii.is_primary = 1
              AND ii.id_item = :id_item
SQL;
        $catalogue = DB::select('SELECT * FROM catalogue WHERE alias = :alias', [
            'alias' => $catalogueAlias,
        ]);

        if (empty($catalogue)) {
            return view('404');
        } else {
            $catalogue = $catalogue[0];
        }

        $items = DB::select('
            SELECT i.*, c.alias catalogue_alias 
            FROM item i, catalogue c
            WHERE i.id_catalogue=:id_catalogue
              AND c.id = i.id_catalogue
            ORDER BY i.id DESC', [
            'id_catalogue' => $catalogue->id
        ]);

        $itemsCount = count($items);

        foreach ($items as &$item) {
            $images = DB::select($sql, [
                'id_item' => $item->id,
            ]);

            if (!empty($images)) {
                $item->main_image = $images[0];
            }
        }

        return view('catalogue.list', [
            'templateData' => [
                'showSorting' => true,
                'categories' => $cats,
                'items' => $items,
                'itemsCount' => $itemsCount,
                'categoryName' => $catalogue->name,
                'catalogue' => $catalogue,
            ],
        ]);
    }

    public function showItem($catalogueAlias, $aliasAndId)
    {
        preg_match("~(.+)-(\d+)~", $aliasAndId, $res);

        if (!isset($res[1], $res[2])) {
            return view('404');
        }

        $item = DB::select('
            SELECT i.*, c.alias catalogue_alias
            FROM item i, catalogue c 
            WHERE i.id=:id 
                AND c.id = i.id_catalogue
                AND i.alias=:alias', [
            'id' => (int)$res[2],
            'alias' => (int)$res[1],
        ]);

        if (empty($item)) {
            return view('404');
        } else {
            $item = $item[0];
        }


        $sql = <<<SQL
            SELECT i.id, i.url, ii.is_primary
            FROM image i, item_image ii
            WHERE i.id = ii.id_image 
                AND ii.id_item = :id_item
SQL;

        $images = DB::select($sql, [
            'id_item' => $item->id,
        ]);

        $mainImage = null;
        for ($i = 0, $l = count($images) ; $i < $l ; $i++) {
            if ((int)$images[$i]->is_primary === 1) {
                $mainImage = $images[$i];
                unset($images[$i]);
                break;
            }
        }

        return view('catalogue.item', [
            'templateData' => [
                'item' => $item,
                'mainImage' => $mainImage,
                'images' => $images,
            ]
        ]);
    }

    public function test()
    {
        echo "<pre>";
        $listId = '69cc4edc88';

        try {
//            $res = $this->mailchimp
//                ->lists
//                ->subscribe(
//                    $listId,
//                    [
//                        'email' => 'gavrashenko@gmail.com'
//                    ],
//                    null,
//                    'html',
//                    false
//                );
//
//            print_r($res);


            $options = [
                'list_id'   => $listId,
                'subject' => "Ваш заказ Нормас",
                'from_name' => "Нормас",
                'from_email' => 'noreply@normas.com.ua',
                'to_name' => 'gavrashenko@gmail.com'
            ];

            $content = [
                'html' => "<h1>Спасибо за Ваш заказ</h1>",
                'text' => "Спасибо за Ваш заказ"
            ];

            $campaign = $this->mailchimp->campaigns->create('regular', $options, $content);


            print_r($campaign);

            $res = $this->mailchimp->campaigns->send($campaign['id']);

            print_r($res);

        } catch (\Mailchimp_List_AlreadySubscribed $e) {
            print_r($e->getMessage());
        } catch (\Mailchimp_Error $e) {
            print_r($e->getMessage());
        }
    }
}