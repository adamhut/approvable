<?php

namespace Adamhut\Approvable;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Adamhut\Approvable\Skeleton\SkeletonClass
 */
class ApprovableFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'approvable';
    }
}
