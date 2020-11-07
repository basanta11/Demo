<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class FeildCategoryPivot extends Model
{
    use   LaravelVueDatatableTrait;

   protected $table='category_feild';
   protected $dataTableColumns = [
    'id' => [
        'searchable' => false,
    ],
    'feild_id' => [
    ],
    'category_id' => [
    ],
   
    
   
];
}
