<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;


class Area extends Model
{
    protected $fillable = ['name','slug'];
    use SoftDeletes ,Sluggable,LaravelVueDatatableTrait ;

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
        
       
    ];
    public function business(){
        return $this->hasMany(BusinessProfile::class);
    }
}
