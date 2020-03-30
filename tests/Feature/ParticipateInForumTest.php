<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_user_may_not_add_replies()
    {
        $this->withoutExceptionHandling();

        $this->expectException('Illuminate\Auth\AuthenticationException');

        $thread = factory(Thread::class)->create();

        // $this->post($thread->path() . '/replies',  $reply->toArray());
        $this->post(route('reply.store', ['thread' => $thread]),  []);
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $thread = factory(Thread::class)->create();

        $reply = factory(Reply::class)->make();

        $this->post(route('reply.store', ['thread' => $thread]),  $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }
}
