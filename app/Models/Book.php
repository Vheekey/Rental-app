<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const AVAILABLE = 1;
    const UNAVAILABLE = 0;

    protected static function booted()
    {
        static::creating(function ($book){
            do {
                $code = strtoupper(Str::random(6));
                $duplicate = Book::where('code', $code)->first();
                $book->code = $code;
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
