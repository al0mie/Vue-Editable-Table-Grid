<?php

namespace App;

use Silex\Application;

/**
 * Class ServicesLoader
 * @package App
 */
class ServicesLoader
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * ServicesLoader constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Bind services with container
     */
    public function bindServicesIntoContainer()
    {
        $this->app['user.service'] = function() {
            return new Services\UserService($this->app['db']);
        };
    }
}

