<?php

namespace App\Forms;

use App\Models\TableCode;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

class Insert extends Form
{
    public function buildForm()
    {
        foreach (Schema::getColumnListing($this->model) as $column) {
            switch (Schema::getColumnType($this->model, $column)) {
                case 'date':
                    $type = 'date';
                    break;
                case 'datetime':
                    $type = 'datetime-local';
                    break;
                case 'string':
                    $type = 'text';
                    break;
                case 'integer':
                    $type = 'number';
                    break;
                case 'text':
                    $type = 'textarea';
                    break;
                case 'timestamp':
                    $type = 'datetime';
                    break;
                default:
                    $type = 'text';
                    break;
            }

            if ($this->isForeign($this->model, $column)) {
                if (($column === 'created_by') || ($column === 'updated_by') || ($column === 'deleted_by')) {}
                else {
                    $plural = Str::plural(Str::replace('_id', '', $column));
                    if (Schema::hasTable($plural)) { $child = DB::table($plural); }

                    $singular = Str::singular(Str::replace('_id', '', $column));
                    if (Schema::hasTable($singular)) { $child = DB::table($singular); }

                    $this->add(Str::replace('_id', '', $column), 'static', [
                        'label' => Str::replace('_id', '', $column),
                        'label_show' => false,
                        'tag' => 'a',
                        'attr' => [
                            'class' => 'small fw-semibold dotted',
                            'href' => route('master.fetch', $this->getTableCode($column))
                        ],
                        'value' => 'Tambah [' . Str::replace('_id', '', $column) . '] baru'
                    ]);

                    $this->add($column, 'select', [
                        'label' => Str::replace('_id', '', $column),
                        'label_show' => true,
                        'label_attr' => [
                            'class' => 'form-label',
                            'for' => $column
                        ],
                        'choices' => $child->orderBy('id')->pluck('name', 'id')->toArray(),
                        'empty_value' => 'Pilih satu',
                        'attr' => [
                            'class' => 'form-select form-select-sm select2-single-modal'
                        ],
                        'wrapper' => [
                            'class' => 'form-select-floating mb-1'
                        ]
                    ])->getField($column)->setValue(null);
                }
            } else {
                if ($column === 'id') {}
                else if (($column === 'created_at') || ($column === 'updated_at') || ($column === 'deleted_at')) {}
                else if ($type == 'date' || $type == 'datetime-local') {
                    $this->add($column, $type, [
                        'label' => $column,
                        'label_show' => true,
                        'label_attr' => [
                            'class' => 'form-label',
                            'for' => $column
                        ],
                        'attr' => [
                            'class' => 'form-control form-control-sm',
                            'autocomplete' => 'off',
                            'placeholder' => $column
                        ],
                        'wrapper' => [
                            'class' => 'form-date-floating my-1'
                        ]
                    ])->getField($column)->setValue(null);
                } else {
                    $this->add($column, $type, [
                        'label' => $column,
                        'label_show' => false,
                        'label_attr' => [
                            'class' => 'form-label',
                            'for' => $column
                        ],
                        'attr' => [
                            'class' => 'form-control form-control-sm',
                            'autocomplete' => 'off',
                            'placeholder' => $column
                        ],
                        'wrapper' => [
                            'class' => 'form-group my-1'
                        ]
                    ])->getField($column)->setValue(null);
                }
            }
        }

        /* BTN-SUBMIT-ON-MODAL */
        /* ==================================================================================== */
        $this->add('Simpan', 'submit',
            ['attr' => [
                'class' => 'btn btn-color btn-sm w-100 d-none',
                'id' => 'btn-modal'
            ]
        ]);
    }

    protected function isForeign(string $table, string $column) {
        $columns = Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($table);
        return collect($columns)->map(function($item) {
            return $item->getColumns();
        })->flatten()->contains($column);
    }

    protected function getTableCode(string $column) {
        $table = Str::snake(Str::plural(Str::replace('_id', '', $column)));
        $code = TableCode::where('name', $table)->first()->code;
        return $code;
    }
}

/* text, email, url, tel, search, password, hidden, number, date, file, image, color, datetime-local, month, range, time, week, select, textarea, button, buttongroup, submit, reset, radio, checkbox, choice, form, entity, collection, repeated, static */