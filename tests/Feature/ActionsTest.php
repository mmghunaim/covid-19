<?php

namespace Tests\Feature;

use App\Action;
use App\Http\Controllers\ActionController;
use App\Http\Requests\ActionRequest;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function unauthenticated_users_cannot_create_action()
    {
        $this->get('actions/create')->assertRedirect('login');

        $this->post('actions', ['actions' => ['actions' => 'this is action']])->assertRedirect('login');
    }

    /** @test * */
    public function a_user_can_add_action()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->post('actions', ['action' => 'Play games'])
            ->assertStatus(302)
            ->assertRedirect($user->path());

        $this->assertActionUsesFormRequest(
            ActionController::class,
            'store',
            ActionRequest::class
        );

        $this->assertCount(1, $user->actions);

        $this->assertEquals('Play games', $user->actions()->first()->action);
    }

    /** @test * */
    public function a_user_can_update_action()
    {
        $action = factory(Action::class)->create(['action' => 'before change']);

        $this->assertEquals('before change', $action->action);

//        $this->actingAs($action->user)->get($action->path() . '/edit')->assertStatus(200);

        $this->actingAs($action->user)
            ->patch($action->path(), $data = [
                'action' => 'action changed',
            ])
            ->assertRedirect($action->user->path());

        $this->assertActionUsesFormRequest(
            ActionController::class,
            'update',
            ActionRequest::class
        );

        $this->assertDatabaseHas('actions', $data);

        $action->refresh();

        $this->assertEquals('action changed', $action->action);
    }

    /** @test * */
    public function a_user_can_delete_action()
    {
        $action = factory(Action::class)->create(['action' => 'before change']);

        $this->actingAs($action->user)
            ->delete($action->path())
            ->assertRedirect($action->user->path());

        $this->assertDatabaseMissing('actions', $action->only('id'));
    }

    /** @test **/
    public function unauthorized_users_cannot_update_or_delete_action()
    {
        $foo = factory(User::class)->create();

        $bar = factory(User::class)->create();

        $action = factory(Action::class)->create(['user_id' => $foo->id]);

        $this->actingAs($bar)
            ->patch($action->path(), $data = [
                'action' => 'action changed',
            ])
            ->assertStatus(403);

        $this->actingAs($bar)
            ->delete($action->path())
            ->assertStatus(403);
    }

    /** @test * */
    public function invalid_creation_data_show_error_messages()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->post('actions')->assertSessionHasErrors('action');
    }

    /** @test * */
    public function invalid_update_data_show_error_messages()
    {
        $action = factory(Action::class)->create(['action' => 'before change']);

        $this->actingAs($action->user)->patch($action->path(), ['action' => '']) ->assertSessionHasErrors('action');
    }
}
