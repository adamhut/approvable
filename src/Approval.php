<?php

namespace Adamhut\Approvable;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    //
    protected $guarded = [];

    protected $casts = [
        'approved' => 'boolean'
    ];

    public function approvable()
    {
        //This will find out what the relative activity it related to 
        return $this->morphTo();
    }

    public function scopeDenied($query)
    {
        return $query->where('approved', false);
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }
}
