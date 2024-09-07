<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class SearchBox extends Component
{
    public $search;


    // public function updatedSearch(){
    //     $this->dispatch('search' , search: $this->search);
    // }

    public function updateSearch(){
            $this->dispatch('search' , search: $this->search);
    }

    public function resetSearch(){
        $this->search = "";
        $this->dispatch('search' , search: "");
    }

    // #[On('reset')]
    // public function resetSearchBox(){
    //     $this->search = "";
    // }

    public function render()
    {
        return view('livewire.search-box');
    }
}
