<?php

use App\Models\Menu;

use App\Models\TableCode;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

function menu() {
    $menu = [];
    if (auth()->check()) {
        $roles = auth()->user()->roles->pluck('id');
    	$menu = Menu::whereHas('roles', function($query) use($roles) {
            $query->whereIn('role_id', $roles);
        })->where('active', 1)->orderBy('order_number')->get();
        $render = [];
        foreach ($menu as $element) {
            $parent_id = $element->parent_id;
            $render[$parent_id][] = $element;
        }
    }
	return $menu;
}

function elapsed_date($date) {
	return Carbon::parse($date)->locale('id')->diffForHumans();
}

function date_indo_format($date) {
    $months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $result = getdate(strtotime($date));
    return sprintf('%02d', $result['mday']) . ' ' . $months[$result['mon']] . ' ' . $result['year'];
}

function date_time_indo_format($date) {
    $months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $result = getdate(strtotime($date));

    return sprintf('%02d', $result['mday']) . ' ' . $months[$result['mon']] . ' ' . $result['year'] . ' ' . sprintf('%02d', $result['hours']) . ':' . sprintf('%02d', $result['minutes']) . ':' . sprintf('%02d', $result['seconds']);
}

function get_column_name($table) {
    return Schema::getColumnListing($table);
}

function get_column_type($table) {
    $columns = Schema::getColumnListing($table);
    $column_types = [];
    foreach ($columns as $column) {
        array_push($column_types, Schema::getColumnType($table, $column));
    }
    return $column_types;
}

function get_column_name_and_type($table) {
  $columns = Schema::getColumnListing($table);
  $new_columns = [];
  foreach ($columns as $column) {
    array_push($new_columns, [
      'field' => $column,
      'type' => Schema::getColumnType($table, $column),
    ]);
  }
  return $new_columns;
}

function fresh_card_number($prefix, $region, $id) {
    return $prefix . $region . date('y') . sprintf('%03s', intval(substr($id, -3)) + 1);
}

function incerement_card_number($id) {
    return sprintf('%03s', intval(substr($id, -3)) + 1);
}

function randomizer() {
    $int = rand(0, 25);
    $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return $letters[$int];
}

function generate_table_code() {
    $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
    $result = [];
    TableCode::truncate();
    foreach ($tables as $key => $value) {
        $result[$key]['code'] = Str::uuid();
        $result[$key]['name'] = Str::lower($value);
        $result[$key]['label'] = Str::headline($value);
        TableCode::create($result[$key]);
    }
    return $result;
}