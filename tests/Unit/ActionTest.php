<?php

namespace Tests\Unit;

use App\Action;
use App\Http\Requests\ActionRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function it_has_many_actions()
    {
        $action = factory(Action::class)->create();

        $this->assertInstanceOf('App\User', $action->user);
    }

    /** @test **/
    public function it_have_path_method()
    {
        $action = factory(Action::class)->create();

        $this->assertEquals('actions/'.$action->id, $action->path());
    }

    /** @test **/
    public function validation_rules_on_action_creation()
    {
        $this->assertExactValidationRules([
            'actions' => 'required|array|min:1',
        ], (new ActionRequest())->rules());
    }
}
