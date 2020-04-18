<?php

namespace Tests\Feature;

use App\Channel;
use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReadThreadTest extends TestCase
{
    use RefreshDatabase;

    private $thread;

    public function setUp(): void
    {
        parent::setUp();
        $this->thread = factory(Thread::class)->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $response = $this->get('/threads');
        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {
        $response = $this->get(
                route('threads.show',
                    [
                        'thread' => $this->thread->id,
                        'channel' => $this->thread->channel->id,
                    ]
                )
            );
        $response->assertSee($this->thread->title);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory(Reply::class)
            ->create(['thread_id' => $this->thread->id]);

        $this->get(
            route(
                'threads.show',
                [
                    'thread' => $this->thread->id,
                    'channel' => $this->thread->channel->id,
                ]
            )
        )->assertSee($reply->body);
    }

    /** @test */
    public function a_user_can_filter_threads_acording_to_a_channel()
    {
        $channel = create(Channel::class);
        $threadsInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadsNotInChannel = create(Thread::class);

        $this->get(route('threads.index', ['channel' => $channel->slug]))
            ->assertSee($threadsInChannel->title)
            ->assertDontSee($threadsNotInChannel->title);
    }
}
