<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable=[
        'title','category_id','description','status','type','budget','attachments'
    ];


    protected $casts=[
        'budget'=>'float',
        'attachments'=>'json', 
        

    ];

    const TYPE_FIXED ='fixed';

    const TYPE_HOURLY ='hourly'; 


    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }  
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function tags(){
        return $this->belongsToMany(
            Tag::class, //Related Model
            'project_tag', //Pivot table
            'project_id', //F.K for current model in pivot table
            'tag_id',       //F.K for related model in pivot table
            'id',    //current model Key(p.k.)
            'id'    //related model key (p.k. related model)

        );
    }

    public static function types(){
        return[
            self::TYPE_FIXED => 'Fixed',
            self::TYPE_HOURLY=>'Hourly'

        ];
    }

    public function syncTags(array $tags){
        $tags_id=[];
        foreach($tags as $tag_name){
        $tag=Tag::firstOrCreate([
            'slug'=> Str::slug($tag_name) //check if the slug exist or not
        ],[
            'name'=>trim($tag_name) //trim to ignore spaces
        ]);
            $tags_id[]=$tag->id;
        }
        $this->tags()->sync($tags_id);
         
        
        //Other Methods
        //attach add only
        //deattach the oppiste of attach

        //sync without detaching don't remove
    }

    
}
