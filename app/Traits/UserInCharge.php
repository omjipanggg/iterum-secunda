<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

trait UserInCharge
{
    protected static function bootUserInCharge()
    {
        static::creating(function ($model) {
            if (Schema::hasColumns($model->getTable(), ['created_by', 'updated_by'])) {
                try {
                    $user = Auth::user();
                    if ($user) {
                        $model->created_by = $user->id;
                        $model->updated_by = $user->id;
                    }
                } catch (UnsatisfiedDependencyException $e) {
                    abort(500, $e->getMessage());
                }
            }
        });

        static::updating(function ($model) {
            if (Schema::hasColumns($model->getTable(), ['updated_by'])) {
                try {
                    $user = Auth::user();
                    if ($user) {
                        $model->updated_by = $user->id;
                    }
                } catch (UnsatisfiedDependencyException $e) {
                    abort(500, $e->getMessage());
                }
            }
        });

        static::deleting(function ($model) {
            if (Schema::hasColumns($model->getTable(), ['deleted_by'])) {
                try {
                    $user = Auth::user();
                    if ($user) {
                        $model->deleted_by = $user->id;
                    }
                } catch (UnsatisfiedDependencyException $e) {
                    abort(500, $e->getMessage());
                }
            }
        });
    }
}
