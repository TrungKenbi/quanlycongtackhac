<?php
/*
 * Copyright (c) 2021 TrungKenbi
 */

namespace Tests\Unit\Http\Controllers;


use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * Test index page correct view
     *
     * @return void
     */
    public function test_index_returns_view()
    {
        $controller = new UserController();
        $request = new Request();
        $view = $controller->index($request);

        $this->assertEquals('users.index', $view->getName());
        $this->assertArrayHasKey('data', $view->getData());
    }


    /**
     * Test create page correct view
     *
     * @return void
     */
    public function test_create_returns_view()
    {
        $controller = new UserController();

        $view = $controller->create();

        $this->assertEquals('users.create', $view->getName());
        $this->assertArrayHasKey('roles', $view->getData());
    }

    /**
     * Create new user from Faker data
     *
     * @return void
     */
    public function testCreateUser()
    {
        // Generate user data from Faker, default password is "password"
        $user = factory(User::class)->make();

        // Save model to database
        $result = $user->save();

        // Check model is save?
        $this->assertTrue($result);

        // Get already created from database
        $userFromDatabase = User::find($user->id);

        // Check again
        $this->assertTrue($userFromDatabase != null);
    }

    /**
     * Test login page
     *
     * @return void
     */
    public function testLogin() {
        $credential = [
            'email' => 'hieuleggo1280@gmail.com',
            'password' => '12345678'
        ];

        $response = $this->post('/login', $credential);
        $response->assertSessionMissing('errors');
    }

    /**
     * Test login page but fail
     *
     * @return void
     */
    public function testLoginFalse() {
        $credential = [
            'email' => 'hieuleggo1280@gmail.com',
            'password' => '234567899' // wrong password
        ];

        $response = $this->post('/login', $credential);

        $response->assertSessionHasErrors();
    }
}
