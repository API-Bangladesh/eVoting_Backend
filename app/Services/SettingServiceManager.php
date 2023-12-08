<?php


namespace App\Services;


class SettingServiceManager
{

    /**
     * @var
     */
    private $app;

    /**
     * Constructors
     *
     * @param $app
     * @param $setting
     */
    public function __construct($app, $setting)
    {
        $this->app = $app;
        $this->setting = $setting;
    }

    /**
     * Instance
     *
     * @return mixed
     */
    public function instance()
    {
        return $this->setting;
    }

    /**
     * Get setting value
     *
     * @param $column
     * @return mixed|null
     */
    public function get($column)
    {
        return $this->setting->$column ?? Null;
    }

    /**
     * Update setting value
     *
     * @param $column
     * @param $value
     * @return mixed
     */
    public function put($column, $value)
    {
        $this->setting->$column = $value;
        return $this->setting->update();
    }
}
