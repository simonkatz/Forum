<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
  use DatabaseMigrations;
    
    /** @test */
    public function guest_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');
        
        $this->get('/threads/create')
             ->assertRedirect('login');
        
        $this->post('/threads')
             ->assertRedirect('login');
        
    }
    
    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();
        
        $thread = create('App\Thread');
        
        $this->post('/threads', $thread->toArray());
        
        $this->get($thread->path())
             ->assertSee($thread->title)
             ->assertSee($thread->body);
        
    }
}
