<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{
    use WithPagination;

    public $message = 'Bem Vindo ao Tweet!';

    public $rules = [
        'message' => 'required|min:3|max:5000'
    ];

    public function render()
    {
        $tweets = Tweet::with('user')->latest()->paginate(4);

        return view('livewire.show-tweets', [
            'tweets' => $tweets
        ]);
    }

    public function create()
    {
        $this->validate();

        auth()->user()->tweets()->create([
              'message' => $this->message,
        ]);

        /*Tweet::create([
              'content' => $this->message,
              'user_id' => auth()->user()->id,
        ]);
        */

        $this->message = '';
    }

    public function like($idTweet)
    {
          $tweet = Tweet::find($idTweet);

          $tweet->likes()->create([
            'user_id' => auth()->user()->id
          ]);
    }

    public function unlike(Tweet $tweet)
    {
          $tweet->likes()->delete();
    }

}

