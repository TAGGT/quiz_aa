<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_block_id',
        'text',
        'answer',
        'choice1',
        'choice2',
        'choice3'
    ];


    public function quiz_block(){
        return $this->belongsTo(Quiz_blocks::class);
    }

    public function advice_texts(){
        return $this->hasMany(Advice_text::class);
    }

    public function advice_pictures(){
        return $this->hasMany(Advice_picture::class);
    }
}
