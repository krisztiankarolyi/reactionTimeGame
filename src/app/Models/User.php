<?php 

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Friendship;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
   
/*
    public function car()
    {
       return $this->hasOne( autok::class, 'id', 'auto_id' );
    } 
*/ 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'birthday', 
        'avatar',
        'blocked'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected function friendsOfThisUser()
    {
        return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
        ->withPivot('status')
        ->wherePivot('status', 'confirmed');
    }
 
    // friendship that this user was asked for
    protected function thisUserFriendOf()
    {
        return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
        ->withPivot('status')
        ->wherePivot('status', 'confirmed');
    }
 
    // accessor allowing you call $user->friends
    public function getFriendsAttribute()
    {
        if ( ! array_key_exists('friends', $this->relations)) $this->loadFriends();
        return $this->getRelation('friends');
    }
 
    protected function loadFriends()
    {
        if ( ! array_key_exists('friends', $this->relations))
        {
        $friends = $this->mergeFriends();
        $this->setRelation('friends', $friends);
    }
    }
 
    protected function mergeFriends()
    {
        if($temp = $this->friendsOfThisUser)
        return $temp->merge($this->thisUserFriendOf);
        else
        return $this->thisUserFriendOf;
    }


    protected function friendsOfThisUserBlocked()
    {
        return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
                    ->withPivot('status', 'acted_user')
                    ->wherePivot('status', 'blocked')
                    ->wherePivot('acted_user', 'first_user');
    }
 
    // friendship that this user was asked for but now blocked
    protected function thisUserFriendOfBlocked()
    {
        return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
                    ->withPivot('status', 'acted_user')
                    ->wherePivot('status', 'blocked')
                    ->wherePivot('acted_user', 'second_user');
    }
 
    // accessor allowing you call $user->blocked_friends
    public function getBlockedFriendsAttribute()
    {
        if ( ! array_key_exists('blocked_friends', $this->relations)) $this->loadBlockedFriends();
            return $this->getRelation('blocked_friends');
    }
 
    protected function loadBlockedFriends()
    {
        if ( ! array_key_exists('blocked_friends', $this->relations))
        {
            $friends = $this->mergeBlockedFriends();
            $this->setRelation('blocked_friends', $friends);
        }
    }
 
    protected function mergeBlockedFriends()
    {
        if($temp = $this->friendsOfThisUserBlocked)
            return $temp->merge($this->thisUserFriendOfBlocked);
        else
            return $this->thisUserFriendOfBlocked;
    }

    public function friend_requests()
    {
        return $this->hasMany(Friendship::class, 'second_user')
        ->where('status', 'pending');

    }

    public function block()
    {
        $this->attributes['blocked'] = 1;
        $this->save();
    }

    public function isblocked()
    {
        return $this->blocked;
    }

       public function unblock()
    {
        $this->attributes['blocked'] = 0;
        $this->save();
    }

    public function age()
    {
        return Carbon::parse($this->attributes['birthday'])->age;
    }
}
