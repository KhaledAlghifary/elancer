<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public $timestamps=false;
    protected $fillable=[
        'name','slug'
    ];

    public function projects(){
        return $this->belongsToMany(
            Peoject::class, //Related Model
            'project_tag', //Pivot table
            'tag_id', //F.K for current model in pivot table
            'project_id',       //F.K for related model in pivot table
            'id',    //current model Key(p.k.)
            'id'    //related model key (p.k. related model)

        );
    }
}
