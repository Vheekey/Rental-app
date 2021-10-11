<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Equipment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const AVAILABLE = 1;
    const UNAVAILABLE = 0;

    protected static function booted()
    {
        static::creating(function ($equipment){
            do {
                $code = strtoupper(Str::random(6));
                $duplicate = Equipment::where('code', $code)->first();
                $equipment->code = $code;
            } while (! empty($duplicate));
        });
    }

    public function activity()
    {
        return $this->morphMany(Activity::class, 'itemable');
    }

    public function availability()
    {
        if($this->status){
            return 'AVAILABLE';
        }

        return 'UNAVAILABLE';
    }
}
