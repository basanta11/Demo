<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowListing extends Model
{
  protected $fillable=['user_id','business_id'];
}
