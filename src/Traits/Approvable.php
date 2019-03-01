<?php

namespace Adamhut\Approvable\Traits;

use Adamhut\Approvable\Approval;

trait Approvable
{
    public function approve($remark=null)
    {
        if ($this->approval) {
            $this->approval->approved = true;
            $this->approval->save();
            return $this;
        }
        $this->approval()->create([
            'approved' => true,
            'remark' => '',
        ]);
        return $this;
    }

    public function deny($remark='')
    {
        if ($this->approval) {
            $this->approval->approved = false;
            $this->approval->save();
            return $this;
        }

        $this->approval()->create([
            'approved' => false,
            'remark' => $remark,
        ]);
        return $this;
    }

    public function isApproved()
    {
        return $this->approval && $this->approval->approved == true;
    }

    public function isDenied()
    {
        return $this->approval && $this->approval->approved == false;
    }

    public function isPending()
    {
        return !$this->approval;
    }

    public function approval()
    {
        return $this->morphOne(Approval::class, 'approvable');
    }

    public function scopeApproved($query)
    {
        return $query->whereHas('approval', function ($query) {
            $query->where('approved', true);
        });
    }

    public function scopeDenied($query)
    {
        return $query->whereHas('approval', function ($query) {
            $query->denied();
        });
    }

    public function scopePending($query)
    {
        return $query->whereDoesntHave('approval');
    }

    public function scopeWithDecision($query)
    {
        return $query->with('approval');
    }
}
