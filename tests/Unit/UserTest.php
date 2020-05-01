<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test * */
    public function it_has_many_actions()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(Collection::class, $user->actions);
    }

    /** @test * */
    public function it_have_path_method()
    {
        $user = factory(User::class)->create();

        $this->assertEquals('/users/' . $user->id, $user->path());
    }

    /** @test * */
    public function it_have_add_actions_method()
    {
        $user = factory(User::class)->create();

        $user->addAction(['action' => 'zoom with friends']);

        $this->assertCount(1, $user->actions);
    }
}
