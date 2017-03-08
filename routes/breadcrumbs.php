<?php

Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Нормас', route('home'));
});

Breadcrumbs::register('catalogue', function($breadcrumbs, $alias)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push($alias, route('catalogue', $alias));
});

Breadcrumbs::register('item', function($breadcrumbs, $catalogueAlias, $aliasAndId)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push($catalogueAlias, route('catalogue', $catalogueAlias));
    $breadcrumbs->push($aliasAndId, route('item', compact(['catalogueAlias', 'aliasAndId'])));
});