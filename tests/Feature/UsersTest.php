<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function a_user_can_register()
    {
        $data = [
            'name'                  => 'foo',
            'email'                 => 'foo@bar.com',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ];

        $this->post('register', $data)
            ->assertStatus(302)
            ->assertRedirect('/');

        $this->assertEquals(1, User::count());

        $user = User::find(1);

        $this->assertEquals($data['name'], $user->name);

        $this->assertEquals($data['email'], $user->email);
    }

    /** @test * */
    public function a_user_can_login()
    {
        factory(User::class)->create(['email' => 'foo@bar.com']);

        $data = [
            'email'                 => 'foo@bar.com',
            'password'              => 'password',
        ];

        $this->post('register', $data)
            ->assertStatus(302)
            ->assertRedirect('/');
    }
}
