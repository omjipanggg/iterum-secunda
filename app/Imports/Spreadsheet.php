<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
// use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
// use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
// use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
// use Maatwebsite\Excel\Concerns\WithUpserts;

class Spreadsheet implements ToModel, WithHeadingRow
{
	protected $model;

	public function __construct($model) {
		$this->model = $model;
	}

	// public function getCsvSettings() { return ['delimiter' => ';']; }
	public function startRow() { return 2; }

	public function model(array $row) {
		return (new $this->model)->fill($row);
	}
}