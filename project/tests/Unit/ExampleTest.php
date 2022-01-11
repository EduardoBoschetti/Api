<?php

namespace Tests\Unit;

use Tests\TestCase;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_send_email_forgot_password()
    {
        $response = $this->PostJson('/api/forgot-password', ['email' => 'Teste@gmail.com.br']);

        $response
            ->assertStatus(200);
            
    }

    /*public function test_store_user()
    {
        $response = $this->postJson('/api/data', [
            'email' => 'Teste006@gmail.com.br',
            'name' => 'Boschetti Du',
            'password' => 'senha123@'
        ]);

        $response->assertStatus(200);
    }*/

    public function test_get_user()
    {
        $response = $this->getJson('/api/data/30');

        $response->assertStatus(200);
    }

    /*public function test_delete_user()
    {
        $response = $this->deleteJson('/api/data/29');

        $response->assertStatus(200);
    }*/

    public function test_reset_password()
    {
        $response = $this->postJson('api/reset-password', [
            'token'=>'wGSg5Meo69',
            'password'=>'senha1234@',
            'password_confirm'=>'senha1234@'
        ]);

        $response->assertStatus(200);
    }

    public function test_login_auth_sanctum()
    {
        $response = $this->postJson('api/auth/login', [
            'email'=>'Teste005@gmail.com.br',
            'password'=>'senha1234@'
        ]);

        $response->assertStatus(200);
    }
}
