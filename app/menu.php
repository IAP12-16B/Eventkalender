<?php

/**
 * @link https://github.com/lavary/laravel-menu
 */

Menu::make('Main', function (\Lavary\Menu\Builder $menu) {
    $eventsItem = $menu->add('Events', array('route' => 'show.index'));
    $eventsItem->add('Program', array('route' => 'show.index'));
    $eventsItem->add('Archive', array( 'route' => 'show.archive'));
});

Menu::make('Admin', function (\Lavary\Menu\Builder $menu) {
    $eventsItem = $menu->add('Events', array('route' => 'show.index'));
    $eventsItem->add('Program', array('route' => 'show.index'));
    $eventsItem->add('Archive', array( 'route' => 'show.archive'))->divide(); // todo active only on archive
    $eventsItem->add('Manage Events', array('route' => 'admin.event.index'));
    $eventsItem->add('Create Event', array('route' => 'admin.event.create'));

    /*$usersItem = $menu->add('Users', array('route' => 'admin.user.index'));
    $usersItem->add('Manage Users', array('route' => 'admin.user.index'));
    $usersItem->add('Create User', array('route' => 'admin.user.create'));*/

    $genreItem = $menu->add('Genres', array('route' => 'admin.genre.index'));
    $genreItem->add('Manage Genres', array('route' => 'admin.genre.index'));

    $pricegroupItem = $menu->add('Pricegroups', array('route' => 'admin.pricegroup.index'));
    $pricegroupItem->add('Manage Pricegroups', array('route' => 'admin.pricegroup.index'));

    // todo settings page
});