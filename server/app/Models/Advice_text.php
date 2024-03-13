<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advice_text extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'user_id',
        'text',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }
}
