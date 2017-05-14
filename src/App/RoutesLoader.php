<?php

namespace App;

use Silex\Application;

/**
 * Class RoutesLoader
 * @package App
 */
class RoutesLoader
{
    /**
     * @var Application
     */
    private $app;

    /**
     * RoutesLoader constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();

    }

    /**
     * Instance of controllers
     */
    private function instantiateControllers()
    {
        $this->app['user.controller'] = function() {
            return new Controllers\UserController($this->app['user.service']);
        };
    }

    /**
     * Bind routes with controllers
     */
    public function bindRoutesToControllers()
    {
        $api = $this->app['controllers_factory'];

        $api->get('/users', 'user.controller:getAll');
        $api->get('/users/{id}', 'user.controller:getOne');
        $api->post('/users', 'user.controller:save');
        $api->patch('/users/{id}', 'user.controller:update');
        $api->delete('/users/{id}', 'user.controller:delete');

        $this->app->mount($this->app['api.endpoint'].'/', $api);

        $this->app->get('/', function () {
            return $this->app['twig']->render('index.twig');
        });
    }
}

