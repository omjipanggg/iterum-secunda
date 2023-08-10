<?php

namespace App\Forms;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

class Insert extends Form
{
    public function buildForm()
    {
        $this->add('name', 'text', [
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Nama',
            ],
            'label' => 'name',
            'label_show' => false
        ]);
    }
}
