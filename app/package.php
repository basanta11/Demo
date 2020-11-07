<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class package extends Model
{
    use SoftDeletes,LaravelVueDatatableTrait;
    protected $fillable=['name','description','category_id','days','price'];

    protected $dataTableColumns = [
        'id' => [
            'searchable' => false,
        ],
        'name' => [
            'searchable' => true,
        ],
        'description' => [
        ],
        'category_id' => [
        ],
        'days' => [
        ],
        'price' => [
        ],
        
        
       
    ];
}
