<?php

use Livewire\Volt\Component;

new class extends Component {
    public int $totalPages;
    public int $currentPage = 1;
    public array $pagination = [];


    public function mount(): void
    {
        $this->getPagination();
    }

    public function setPage(int $page): void
    {
        if ($this->currentPage == $page) return;
        $this->currentPage = $page;
        $this->getPagination();
        $this->dispatch('page-updated', currentPage: $this->currentPage - 1)->to('pages.products');
    }

    public function getPagination(): void
    {
        $pagination = [];
        // Add the first three pages or all if totalPages <= 3
        for ($i = 1; $i <= min(3, $this->totalPages); $i++) {
            $pagination[] = $i;
        }

        // Add "..." if the currentPage is beyond 4
        if ($this->currentPage > 4) {
            $pagination[] = -1; // Represent "..." placeholder
        }

        // Middle range around the currentPage
        $start = max(4, $this->currentPage - 1);
        $end = min($this->currentPage + 1, $this->totalPages - 3);

        for ($i = $start; $i <= $end; $i++) {
            $pagination[] = $i;
        }

        // Add "..." if there are pages beyond the visible range
        if ($this->currentPage < $this->totalPages - 3) {
            $pagination[] = -1; // Represent "..." placeholder
        }

        // Add the last three pages or more if the total pages are fewer
        for ($i = max($this->totalPages - 2, 4); $i <= $this->totalPages; $i++) {
            $pagination[] = $i;

        }
        $this->pagination = $pagination;

    }
};

?>
<div x-data="paginationScroll()" class="flex justify-center items-center mt-4 gap-5 my-5">
    <button
        @click=" scrollToId('product-container')"
        wire:click="setPage({{ 1 }})"
        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md  ">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m17 16-4-4 4-4m-6 8-4-4 4-4"/>
          </svg>
          
    </button>
    @foreach($pagination as $pag)
        <button
            @click="scrollToId('product-container')"
            wire:click="setPage({{ $pag }})"
            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md {{ $pag == $currentPage ? 'bg-blue-500 text-white' : 'hover:bg-gray-300' }} "
            {{ $pag < 0 ? 'disabled' : '' }}>
            {{ $pag > 0 ? $pag : '...' }}
        </button>
    @endforeach
    <button
        @click=" scrollToId('product-container')"
        wire:click="setPage({{ $totalPages }})"
        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md  ">
        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 16 4-4-4-4m6 8 4-4-4-4"/>
          </svg>
          
                  
    </button>
</div>


<script defer>
    function paginationScroll() {
        return {
            scrollToId(id) {
                const elementToScroll = document.querySelector(`#${id}`);

                if (elementToScroll) {
                    elementToScroll.scrollIntoView({
                        behavior: 'smooth', // Smooth scrolling
                        block: 'start', // Align the element to the top of the viewport
                    });
                } else {
                    console.warn(`Element with class "${id}" not found.`);
                }
            }
        };
    }
</script>
