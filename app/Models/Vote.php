<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $primaryKey = 'vote_id';
    
    protected $fillable = [
        'option_id', 'qty'
    ];

    public function survey_option(){
        return $this->belongsTo(Survey_option::class, 'option_id');
    }
}
