<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JamesDordoy\LaravelVueDatatable\Traits\LaravelVueDatatableTrait;

class FeildOptions extends Model
{
    use LaravelVueDatatableTrait,SoftDeletes;
    protected $fillable=['feild_id','value'];

    protected $dataTableColumns = [
        'id' => [
            'searchable' => false,
        ],
        'value' => [
            'searchable' => true,
       
        ],
        'feild_id' => [
       
        ],
    ];
}
