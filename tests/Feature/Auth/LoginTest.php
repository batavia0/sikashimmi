<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
/**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_render_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }   
    public function test_submit_login()
    {
        $response = $this->post('/login',[
            'username' => 'usertest',
            'password' => 'UMBr3ll@c0rp',
        ]);
        $this->assertAuthenticated();
    }
    public function test_submit_login_failed()
    {
        $response = $this->post('login',[
            'username' => 'usertest',
            'password' => 'wrongpassword',
        ]);
        $response->assertStatus(302);
    }
}
