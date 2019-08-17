<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'target_amount',
        'start_date',
        'end_date',
    ];

    public function getStartDateByFormat($format){
        return \DateTime::createFromFormat($format, $this->start_date); 
    }

    public function getEndDateByFormat($format){
        return \DateTime::createFromFormat($format, $this->end_date);
    }
}
