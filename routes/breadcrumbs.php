<?php

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Нормас', route('home'));
});

Breadcrumbs::register('catalogue', function($breadcrumbs, $alias)
{
    $catalogue = resolve('storage.catalogue')->getCatalogueByAlias($alias);
    $breadcrumbs->parent('home');
    $breadcrumbs->push($catalogue->name, route('catalogue', $alias));
});

Breadcrumbs::register('item', function($breadcrumbs, $catalogueAlias, $aliasAndId)
{
    $catalogue = resolve('storage.catalogue')->getCatalogueByAlias($catalogueAlias);
    $item = resolve('storage.item')->getItemByAlias($aliasAndId);

    $breadcrumbs->parent('home');
    $breadcrumbs->push($catalogue->name, route('catalogue', $catalogueAlias));
    $breadcrumbs->push($item->name, route('item', compact(['catalogueAlias', 'aliasAndId'])));
});