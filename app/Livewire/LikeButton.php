<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class LikeButton extends Component
{

    // #[Reactive]
    public Post $post;

    public function toggleLike()
    {
        if(auth()->guest()){
            return $this->redirect(route('login') , true);
        }

        $user = auth()->user();

        $hasLike = $user->hasLiked($this->post);

        if($hasLike){
            $user->likes()->detach($this->post);
            return;
        }
        $user->likes()->attach($this->post);

    }
    public function render()
    {
        return view('livewire.like-button');
    }
}
