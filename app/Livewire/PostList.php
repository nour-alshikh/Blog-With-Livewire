<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{

    use WithPagination;

    #[Url()]
    public $sort = "DESC";

    #[Url()]
    public $search = "";
    #[Url()]
    public $category = "";
    #[Url()]
    public $popular = "";


    public function setSort($sort)
    {
        $this->sort =  ($sort ===  "DESC") ? "DESC" : "ASC";
    }

    #[On('search')]
    public function updateSearch($search)
    {

        $this->search = $search;
        $this->resetPage();
    }
    #[On('resetSearch')]
    public function resetSearch()
    {
        $this->search = "";
    }

    public function clearFilters()
    {
        $this->search = "";
        $this->category = "";
        $this->resetPage();
    }

    #[Computed()]
    public function posts()
    {
        return Post::published()
            ->with('author', 'categories')
            ->search($this->search)
            ->when($this->activeCategory, function ($query) {
                $query->withCategory($this->category);
            })
            ->when($this->popular, function ($query) {
                $query->popular();
            })
            ->orderBy('published_at', $this->sort)
            ->paginate(5);
    }

    #[Computed()]
    public function activeCategory()
    {
        if ($this->category === null || $this->category === "") {
            return;
        }
        return Category::where('slug', $this->category)->first();
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
