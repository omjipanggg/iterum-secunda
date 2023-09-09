<?php

namespace App\Forms;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

class Edit extends Form
{
    public function buildForm()
    {
        $type = 'text';
        $columns = collect(DB::select('describe ' . $this->model))->pluck('Field')->toArray();
        foreach ($columns as $column) {
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

            foreach ($this->getData('records') as $record) {
                if ($this->isForeign($this->model, $column)) {
                    if (($column === 'created_by') || ($column === 'updated_by') || ($column === 'deleted_by')) {}
                    else {
                        $plural = Str::plural(Str::replace('_id', '', $column));
                        if (Schema::hasTable($plural)) { $child = DB::table($plural); }

                        $singular = Str::singular(Str::replace('_id', '', $column));
                        if (Schema::hasTable($singular)) { $child = DB::table($singular); }

                        $this->add($column, 'select', [
                            'label' => Str::replace('_id', '', $column),
                            'label_show' => true,
                            'choices' => $child->orderBy('id')->pluck('name', 'id')->toArray(),
                            'empty_value' => 'Pilih satu',
                            'attr' => [
                                'class' => 'form-select form-select-sm select2-single-modal',
                            ],
                            'wrapper' => [
                                'class' => 'form-select-floating my-2'
                            ]
                        ])->getField($column)->setValue(null);
                    }
                } else {
                    if ($column == 'id') {
                        $this->add($column, 'hidden', [
                            'label' => $column,
                            'attr' => [
                                'class' => 'form-control',
                                'autocomplete' => 'off',
                                'disabled' => true
                            ],
                            'value' => $record->$column,
                        ]);
                    }
                    else if ($column == 'created_at' || $column == 'updated_at' || $column == 'deleted_at') {}
                    else {
                        $this->add($column, $type, [
                            'label' => Str::headline(Str::replace('_', ' ', Str::replace('_id', '', $column))),
                            'label_show' => false,
                            'attr' => [
                                'class' => 'form-control form-control-sm',
                                'rows' => 6,
                                'autocomplete' => 'off',
                                'placeholder' => $column
                            ],
                            'value' => $record->$column,
                            'wrapper' => [
                                'class' => 'form-group my-1'
                            ]
                        ])->getField($column)->setValue($record->$column);
                    }
                }
            }
        }
        /* BTN-SUBMIT-ON-MODAL */
        /* ==================================================================================== */
        $this->add('Ubah', 'submit',
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
