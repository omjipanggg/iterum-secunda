<?php

use App\Models\Menu;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

function menus() {
    $menus = [];
    if (auth()->check()) {
        $roles = auth()->user()->roles->pluck('id');
    	$menus = Menu::whereHas('roles', function($query) use($roles) {
            $query->whereIn('role_id', $roles);
        })->where('active', 1)->orderBy('order_number')->get();
        $render = [];
        foreach ($menus as $menu) {
            $parent_id = $menu->parent_id;
            $render[$parent_id][] = $menu;
        }
    }
	return $menus;
}

function elapsed_date($date) {
	return Carbon::parse($date)->locale('id')->diffForHumans();
}

function date_indo_format($date) {
    $monthTuple = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $result = getdate(strtotime($date));
    return sprintf('%02d', $result['mday']) . ' ' . $monthTuple[$result['mon']] . ' ' . $result['year'];
}

function date_time_indo_format($date) {
    $monthTuple = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $result = getdate(strtotime($date));

    return sprintf('%02d', $result['mday']) . ' ' . $monthTuple[$result['mon']] . ' ' . $result['year'] . ' ' . sprintf('%02d', $result['hours']) . ':' . sprintf('%02d', $result['minutes']) . ':' . sprintf('%02d', $result['seconds']);
}

/*
function generate_tables() {
    $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

    $result = [];

	TableCode::truncate();
    foreach ($tables as $key => $value) {
    	$result[$key]['name'] = $value;
    	$result[$key]['code'] = Str::uuid();
    	$result[$key]['label'] = Str::headline(Str::singular($value));
    	$result[$key]['slug'] = Str::slug(Str::singular($value));
		TableCode::create($result[$key]);
    }
}
*/