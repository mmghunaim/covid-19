<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use App\Http\Requests\UserRequest;
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

    /** @test **/
    public function user_can_see_profile()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->get($user->path())
            ->assertSee($user->name)
            ->assertSee($user->email);
    }

    /** @test **/
    public function user_can_see_update_his_profile()
    {
        $user = factory(User::class)->create(['name' => 'foo']);

        $this->assertEquals('foo', $user->name);

        $this->actingAs($user)->get($user->path() . '/edit')->assertStatus(200);

        $this->actingAs($user)
            ->patch($user->path(), $data = [
                'name' => 'bar',
            ])
            ->assertRedirect($user->path());

        $this->assertActionUsesFormRequest(
            UserController::class,
            'update',
            UserRequest::class
        );

        $this->assertDatabaseHas('actions', $data);

        $action->refresh();

        $this->assertEquals('action changed', $action->action);
    }
}
