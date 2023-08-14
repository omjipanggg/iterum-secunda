<?php

namespace App\Forms;

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
                default:
                    $type = 'text';
                    break;
            }

            if ($this->isForeign($this->model, $column)) {
                if (($column === 'created_by') || ($column === 'updated_by') || ($column === 'deleted_by')) {}
                else {
                    $child = Str::plural(Str::replace('_id', '', $column));
                    $this->add($column, 'select', [
                        'label' => Str::replace('_id', '', $column),
                        'label_show' => true,
                        'choices' => DB::table($child)->orderBy('id')->pluck('name', 'id')->toArray(),
                        'empty_value' => 'Pilih satu',
                        'attr' => [
                            'class' => 'form-select form-select-sm select2-multiple-modal',
                        ],
                        'wrapper' => [
                            'class' => 'form-select-floating my-1'
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

    public function isForeign(string $table, string $column) {
        $columns = Schema::getConnection()->getDoctrineSchemaManager()->listTableForeignKeys($table);
        return collect($columns)->map(function($item) {
            return $item->getColumns();
        })->flatten()->contains($column);
    }
}

/* text, email, url, tel, search, password, hidden, number, date, file, image, color, datetime-local, month, range, time, week, select, textarea, button, buttongroup, submit, reset, radio, checkbox, choice, form, entity, collection, repeated, static */