<?php

namespace Prehistorical\Landing;

use Illuminate\Database\Eloquent\Model;

class Textfield extends Model
{
    public $timestamps = false;
    protected static $unguarded = true;

    public function block()
    {
        return $this->belongsTo('Prehistorical\Landing\Block', 'block_name');
    }

    public function group()
    {
        return $this->belongsTo('Prehistorical\Landing\Group', 'group_id');
    }
}
