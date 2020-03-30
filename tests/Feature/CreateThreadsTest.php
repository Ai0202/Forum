<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_may_not_create_new_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        // $thread = factory(Thread::class)->create();

        $this->post(route('threads.store'), []);
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->be(factory(User::class)->create());

        $thread = factory(Thread::class)->make();

        $this->post(route('threads.store'), $thread->toArray());

        $this->get(route('threads.index'))
            ->assertSee($thread->titlw)
            ->assertSee($thread->body);
    }
}
