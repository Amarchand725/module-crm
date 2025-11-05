<?php

namespace App\Modules\Country\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Str;

class Country extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = ['id', 'uuid', 'name', 'status'];

    /**
     * Configure Spatie Activity Log options.
     */
    public function getActivityLogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(strtolower('Country'))
            ->logFillable()
            ->logOnlyDirty();
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->author_id = auth()->id();
            $model->author_type = get_class(auth()->user());
        });
    }
}