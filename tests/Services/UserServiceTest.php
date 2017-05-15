<?php

namespace Tests\Services;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use App\Services\UserService;


class UserServiceTest extends \PHPUnit_Framework_TestCase
{
    private $userService;
    private $app;

    public function setUp()
    {
        $this->app = new Application();
        $this->app->register(new DoctrineServiceProvider(), array(
            'db.options' => array(
                'driver' => 'pdo_mysql',
                'user' => 'user',
                'password' => 'password',
                'dbname' => 'mydb',
                'host' => 'localhost',
                'port' => 3306,
                'memory' => true
            ),
        ));
        $this->userService = new UserService($this->app['db']);

        $stmt = $this->app['db']->prepare("CREATE table users(
                 id INT(11) AUTO_INCREMENT PRIMARY KEY,
                 username VARCHAR(50),
                 email VARCHAR (50),
                 first_name VARCHAR (100),
                 last_name VARCHAR (100),
                 address VARCHAR (255)
                 );");
        $stmt->execute();

        $stmt = $this->app['db']->prepare("INSERT INTO users (username, email, first_name, last_name, address) VALUES ('username', 'email@email.com', 'first_name', 'last_name', 'address')");
        $stmt->execute();
    }

    public function testGetOne()
    {
        $data = $this->userService->getOne(1);
        $this->assertEquals('username', $data['username']);
        $this->assertEquals('email@email.com', $data['email']);
        $this->assertEquals('first_name', $data['first_name']);
        $this->assertEquals('last_name', $data['last_name']);
        $this->assertEquals('address', $data['address']);
    }

    public function testGetAll()
    {
        $data = $this->userService->getAll();
        $this->assertNotNull($data);
    }

    function testSave()
    {
        $user = [
            'username' => 'username',
            'email' => 'test@email.com',
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'address' => 'address'
        ];
        $data = $this->userService->save($user);
        $data = $this->userService->getAll();
        $this->assertEquals(2, count($data));
    }

    function testUpdate()
    {
        $user = [
            'username' => 'username',
            'email' => 'test@email.com',
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'address' => 'address'
        ];
        $this->userService->save($user);
        $user = [
            'username' => 'new_username',
            'email' => 'new_test@email.com',
            'first_name' => 'new_first_name',
            'last_name' => 'new_last_name',
            'address' => 'new_address'
        ];
        $this->userService->update(1, $user);
        $data = $this->userService->getAll();
        $this->assertEquals('new_username', $data[0]['username']);
        $this->assertEquals('new_test@email.com', $data[0]['email']);
        $this->assertEquals('new_first_name', $data[0]['first_name']);
        $this->assertEquals('new_last_name', $data[0]['last_name']);
        $this->assertEquals('new_address', $data[0]['address']);
    }

    function testDelete()
    {
        $user = [
            'username' => 'username',
            'email' => 'test@email.com',
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'address' => 'address'
        ];
        $this->userService->save($user);
        $this->userService->delete(1);
        $data = $this->userService->getAll();
        $this->assertEquals(1, count($data));
    }

    public function tearDown()
    {
        $stmt = $this->app['db']->prepare("DROP TABLE users;");
        $stmt->execute();
    }
}
