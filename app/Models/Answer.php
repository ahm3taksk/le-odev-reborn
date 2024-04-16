<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer_author_name',
        'question_id',
        'answer_text',
        'answer_image',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
