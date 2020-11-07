<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cviebrock\EloquentSluggable\Sluggable;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class category extends Model
{
    protected $fillable = ['name','slug','parent_id','icon'];
    use SoftDeletes ,Sluggable ,LaravelVueDatatableTrait;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    protected $dataTableColumns = [
        'id' => [
            'searchable' => false,
        ],
        'name' => [
            'searchable' => true,
        ],
        'parent_id' => [
        ],
        'icon' => [
        ],
        
       
    ];
    public function business(){
        return $this->belongsToMany(Business::class);
     }
     public function feilds(){
        return $this->belongsToMany(Feilds::class,'category_feild','category_id','feild_id');
     }
     public function posts() {
		return $this->belongsToMany( Post::class,'category_post','category_id','post_id' );
	}


}
