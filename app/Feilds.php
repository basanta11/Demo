<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class Feilds extends Model
{
   
    protected $fillable = ['name','is_required','help','default','max','min','type'];
    use SoftDeletes ,LaravelVueDatatableTrait ;

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
        'is_required' => [
       
        ],   'default' => [
       
        ],   'max' => [
       
        ],
        'min' => [
       
        ], 
        'help' => [
       
        ], 
          'type' => [
            'searchable' => true,

       
        ],
        
        
       
    ];
    public function options(){
        return $this->hasMany(FeildOptions::class,'feild_id');
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'category_feild','feild_id');
    }
   

}
