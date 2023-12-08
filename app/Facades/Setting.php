<?php


namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static instance()
 * @method static get(string $string)
 * @method static put(string $string, string $string)
 */
class Setting extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'setting';
    }
}
