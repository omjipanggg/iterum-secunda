<?php

use App\Models\Menu;
use App\Models\TableCode;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

function menu() {
    $menu = [];
    if (auth()->check()) {
        $roles = auth()->user()->roles->pluck('id');
    	$menu = Menu::whereHas('roles', function($query) use($roles) {
            $query->whereIn('role_id', $roles);
        })->where('active', 1)->orderBy('order_number')->get();
        foreach ($menu as $element) {
            $parent_id = $element->parent_id;
            $render[$parent_id][] = $element;
        }
    }
	return $menu;
}

function is_uuid($uuid) {
    return preg_match('/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/', $uuid) === 1;
}

function table_has_generated() {
    return TableCode::count() > 0;
}

function list_of_table() {
    return TableCode::all();
}

function elapsed_date($date) {
	return Carbon::parse($date)->locale('id')->diffForHumans();
}

function day_indo_format($date) {
    $days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];
    return $days[date('w', strtotime($date))];
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

function to_form_date($date) {
    return date('Y-m-d', strtotime($date));
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

function get_relational_table($table) {
    $data = [];
    foreach (get_column_name($table) as $column) {
        if (Str::substr($column, Str::length($column) - 3, 3) === '_id') {
            $data[] = Str::plural(Str::substr($column, 0, Str::length($column) - 3));
        }
    }
    return $data;
}

function set_prefix($string) {
    $string = strtoupper($string);
    $string = preg_replace('/[^A-Z]/', '', $string);

    $initials = [];

    $words = explode(' ', $string);
    foreach ($words as $word) {
        $initials[] = strtoupper(substr($word, 0, 1));
    }

    while (count($initials) < 3) {
        $initials[] = chr(rand(65, 90));
    }

    return implode('', $initials);
}

function incerement_card_number($id) {
    return sprintf('%03s', intval(Str::substr($id, -3)) + 1);
}

function fresh_card_number($prefix, $region, $id, $year = null) {
    if ($year === null) {
        $year = date('y');
    }

    $id = incerement_card_number($id);

    return $prefix . $region . $year . $id;
}

function randomizer() {
    $number = rand(0, 25);
    $letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $response = $letter[$number];
    // $response = chr(rand(65, 90));
    return $response;
}

function generate_table_code() {
    $tables = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
    $result = [];
    TableCode::truncate();
    foreach ($tables as $key => $table) {
        $result[$key]['code'] = Str::uuid();
        $result[$key]['name'] = Str::lower($table);
        $result[$key]['label'] = Str::headline($table);
        TableCode::create($result[$key]);
    }
    return $result;
}

function month_to_rome($month) {
    $monthTuple = ['0','I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
    return $monthTuple[$month];
}


function number_string($date) {
        $tuple = ['Nol', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima',
        'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];

        $temp = '';

        if ($date < 12) {
            $temp = $tuple[$date];
        } else if ($date < 20) {
            $temp = number_string($date - 10) . ' Belas';
        } else if ($date < 100) {
            if ($date%10 == 0) {
                $temp = number_string($date/10) . " Puluh";
            } else {
                $temp = number_string($date/10) . " Puluh " . number_string($date%10);
            }
        } else if ($date < 200) {
            $temp = " Seratus " . number_string($date-100);
        } else if ($date < 1000) {
            $temp = number_string($date/100) . " Ratus " . number_string($date%100);
        } else if ($date < 2000) {
            $temp = " Seribu " . $number_string($date-1000);
        } else if ($date < 1000000) {
            $temp = number_string($date/1000) . " Ribu " . number_string($date%1000);
        } else {
            $temp = "#REF";
        }
        return trim($temp);
}

function calculate_age($date) {
    $birthdate = new DateTime($date);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthdate);
    return $age->y;
}

function count_duration($start, $end) {
    $start = new DateTime($start);
    $end = new DateTime($end);

    $interval = $start->diff($end);
    $total_days = $interval->format('%d');
    $total_count_days = $interval->format('%a') + 1;

    $total_years = $interval->format('%y');
    $total_months = $end->diff($start)->format('%m');

    if ($total_years > 0) {
        $total_months = $total_months + (12 * $total_years);
    }

    // return trim($total_months . ' (' . number_string($total_months) . ') Bulan, ' . $total_days . ' (' . number_string($total_days) . ') Hari');
    return $total_months . ' bulan, ' . $total_days . ' hari';
}

function publish_sftp_now() {}

function money_indo_format($nominal) {
    return number_format($nominal, 0, ',', '.');
}

function quotes() {
    return [
        [
            'quote' => 'When there is no desire, all things are at peace.',
            'by' => 'Laozi',
            'avatar' => 'https://i.imgur.com/hcfQHVk.png',
        ], [
            'quote' => 'Simplicity is the ultimate sophistication.',
            'by' => 'Leonardo da Vinci',
            'avatar' => 'https://i.imgur.com/fk7VpK6.png',
        ], [
            'quote' => 'Simplicity is the essence of happiness.',
            'by' => 'Cedric Bledsoe',
            'avatar' => '',
        ], [
            'quote' => 'Smile, breathe, and go slowly.',
            'by' => 'Thich Nhat Hanh',
            'avatar' => 'https://i.imgur.com/5dGaFFm.png',
        ], [
            'quote' => 'Simplicity is an acquired taste.',
            'by' => 'Katharine Gerould',
            'avatar' => 'https://i.imgur.com/kw0NM6i.png',
        ], [
            'quote' => 'Well begun is half done.',
            'by' => 'Aristotle',
            'avatar' => 'https://i.imgur.com/rdA2eXg.jpg',
        ], [
            'quote' => 'He who is contented is rich.',
            'by' => 'Laozi',
            'avatar' => 'https://i.imgur.com/hcfQHVk.png',
        ], [
            'quote' => 'Very little is needed to make a happy life.',
            'by' => 'Marcus Antoninus',
            'avatar' => 'https://i.imgur.com/3pzscGh.png',
        ], [
            'quote' => 'It is quality rather than quantity that matters.',
            'by' => 'Lucius Annaeus Seneca',
            'avatar' => 'https://i.imgur.com/wPZwH3H.png',
        ], [
            'quote' => 'Genius is one percent inspiration and ninety-nine percent perspiration.',
            'by' => 'Thomas Edison',
            'avatar' => 'https://i.imgur.com/djylt3R.png',
        ], [
            'quote' => 'Computer science is no more about computers than astronomy is about telescopes.',
            'by' => 'Edsger Dijkstra',
            'avatar' => 'https://i.imgur.com/GBvkWlP.png',
        ], [
            'quote' => 'It always seems impossible until it is done.',
            'by' => 'Nelson Mandela',
            'avatar' => 'https://i.imgur.com/o8d2eiJ.png',
        ], [
            'quote' => 'Act only according to that maxim whereby you can, at the same time, will that it should become a universal law.',
            'by' => 'Immanuel Kant',
            'avatar' => 'https://i.imgur.com/D9MZScY.png',
        ], [
            'quote' => 'Don’t judge each day by the harvest you reap but by the seeds that you plant.',
            'by' => 'Robert Louis Stevenson',
            'avatar' => 'https://i.imgur.com/I9GMkBS.png',
        ], [
            'quote' => 'Write it on your heart that every day is the best day in the year.',
            'by' => 'Ralph Waldo Emerson',
            'avatar' => 'https://i.imgur.com/1v1U8O2.jpg',
        ], [
            'quote' => 'Every moment is a fresh beginning.',
            'by' => 'T.S. Eliot',
            'avatar' => 'https://i.imgur.com/AjK9HKF.png',
        ], [
            'quote' => 'Without His love I can do nothing, with His love there is nothing I cannot do.',
            'by' => 'Unknown',
            'avatar' => '',
        ], [
            'quote' => 'Everything you’ve ever wanted is on the other side of fear.',
            'by' => 'George Addair',
            'avatar' => 'https://i.imgur.com/0YdRYJm.png',
        ], [
            'quote' => 'Begin at the beginning, and go on till you come to the end, then stop.',
            'by' => 'Lewis Carroll',
            'avatar' => 'https://i.imgur.com/s4RfIHa.png',
        ]
    ];
}

function get_random_quotes() {
    return Collection::make(quotes())->random();
}