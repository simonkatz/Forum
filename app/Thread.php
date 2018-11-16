<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];
    
    /**
     * The path to this thread.
     * @return [type] [description]
     */
    public function path()
    {
      return "/threads/{$this->channel->slug}/{$this->id}";
    }
    
    /**
     * Replies to a thread.
     * @return [type] [description]
     */
    public function replies()
    {
      return $this->hasMany(Reply::class);
    }
    
    /**
     * Thread's creator relationship
     * @return [type] [description]
     */
    public function creator()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
    
    /**
     * Add reply to thread
     * @param [type] $reply [description]
     */
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
    
    /**
     * The thread channel relationship.
     * @return [type] [description]
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
