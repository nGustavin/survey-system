<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey_option extends Model
{
    use HasFactory;

    protected $primaryKey = 'option_id';


    protected $fillable = [
        'option_name', 'survey_id'
    ];

    public $timestamps = false;

     public function survey(){
         return $this->belongsTo(Survey::class, 'option_id');
     }

     public function vote(){
         return $this->hasMany(Vote::class, 'option_id');
     }
}
