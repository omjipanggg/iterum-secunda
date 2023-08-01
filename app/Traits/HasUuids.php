<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait HasUuids
{
    protected static function bootHasUuids()
    {
        static::creating(function ($model) {
            try {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            } catch (UnsatisfiedDependencyException $e) {
                abort(500, $e->getMessage());
            }
        });
    }

    public function getIncrementing() {
        return false;
    }

    public function getKeyType() {
        return 'char';
    }
}