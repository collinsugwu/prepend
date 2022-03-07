<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class SessionControllerTest extends TestCase
{
    public function test_login()
    {
        $data = [
            'email' => 'test@test.com',
            'password' => 'password'
        ];
        $res = $this->postJson('api/login', $data);
        $res->assertStatus(Response::HTTP_OK);

        $user = User::where(['email' => 'test@test.com'])->first();
         $resJson =   $res->json();
        $this->assertEquals($user->email, $resJson['user']['email']);
    }
}
