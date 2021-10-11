<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const AVAILABLE = 1;
    const UNAVAILABLE = 0;

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
