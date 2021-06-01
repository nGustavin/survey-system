<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use HasFactory;

    protected $table = "surveys";

    // public function options(){
    //     return $this->hasMany(Survey_option::class);
    // }

    protected $primaryKey = 'survey_id';

    protected $fillable = [
        'description', 'name', 'status', 'start', 'end'
    ];

    public function surveyOptions()
    {
        return $this->hasMany(Survey_option::class, 'survey_id')->select(['option_id', 'name']);
    }
}
