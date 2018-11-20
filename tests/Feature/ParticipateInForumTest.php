<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
  use DatabaseMigrations;
  
  /** @test */
  public function unauthenticated_user_may_not_add_replies()
  {
    $this->expectException('Illuminate\Auth\AuthenticationException');
    
    $this->post('threads/awesome-channel/1/replies', []);
  }
  
  /** @test */
  public function an_authenticated_user_may_participate_in_forum()
  {
    $this->be($user = create('App\User'));
    
    $thread = create('App\Thread');
    
    $reply = make('App\Reply');
    
    $this->post($thread->path() . '/replies', $reply->toArray());
    
    $this->get($thread->path())
         ->assertSee($reply->body);
  }
  
  /** @test */
  public function it_requires_a_body()
  {
      $this->expectException('Illuminate\Validation\ValidationException');
      
      $this->signIn();
      
      $thread = create('App\Thread');
      
      $reply = make('App\Reply', ['body' => null]);
      
      $this->post($thread->path() . '/replies', $reply->toArray())
           ->assertSessionHasErrors('body');
  }
}
