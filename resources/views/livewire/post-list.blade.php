<div class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">

        <div class="flex items-center gap-3">
            @if ($this->activeCategory || $search)
            <button class="bg-gray-900 py-2 px-4 rounded-md text-white" type="button" wire:click='clearFilters()'>
                Clear Filters
            </button>
            @endif
            @if ($this->activeCategory)
            <div>


                <x-badge wire:navigate href="{{ route('posts.index' , ['category' => $this->activeCategory->title]) }}"
                    :textColor="$this->activeCategory->text_color" :bgColor="$this->activeCategory->bg_color">
                    {{ $this->activeCategory->title }}
                </x-badge>
            </div>
            @endif
            @if ($search)
            <div>
                <span>
                    containing :
                </span>
                <strong>
                    <span>
                        {{ $search }}
                    </span>
                </strong>
            </div>
            @endif
        </div>
        <div id="filter-selector" class="flex items-center space-x-4 font-light ">
            <div class="border-r flex items-center">
                <x-checkbox wire:model.live='popular' />
                <x-label class="mx-2">Popular</x-label>
            </div>

            <button
                class=" py-4 {{ $this->sort === 'DESC' ? 'border-b border-gray-700 text-gray-900' : 'text-gray-500' }}"
                wire:click='setSort("DESC")'>Latest</button>
            <button
                class=" py-4  {{ $this->sort === 'ASC' ? 'border-b border-gray-700 text-gray-900' : 'text-gray-500' }}"
                wire:click='setSort("ASC")'>Oldest</button>
        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $post)
        <x-posts.post-item wire-key="{{ $post->id }}" :post="$post" />
        @endforeach
    </div>

    <div class="my-3">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
</div>