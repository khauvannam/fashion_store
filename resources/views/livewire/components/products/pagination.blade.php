<?php

use Livewire\Volt\Component;

new class extends Component {
    public int $totalPages;
    public array $pagination = [];
    public int $page = 1;

    public function mount(int $totalPages): void
    {
        $this->totalPages = $totalPages;
        $this->updatePagination();
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
        $this->updatePagination();
        $this->dispatch('page-updated', currentPage: $this->page - 1)->to('pages.products');
    }

    public function updatePagination(): void
    {

        // Add the first three pages or fewer if totalPages <= 3
        for ($i = 1; $i <= min(3, $this->totalPages); $i++) {
            $pagination[] = $i;
        }

        // Add "..." if the currentPage is beyond 4
        if ($this->page > 4) {
            $pagination[] = -1; // Represent "..." placeholder
        }

        // Middle range around the current page
        $start = max(4, $this->page - 1);
        $end = min($this->page + 1, $this->totalPages - 3);

        for ($i = $start; $i <= $end; $i++) {
            $pagination[] = $i;
        }

        // Add "..." if there are pages beyond the visible range
        if ($this->page < $this->totalPages - 3) {
            $pagination[] = -1; // Represent "..." placeholder
        }

        // Add the last three pages or fewer if there are less than three remaining
        for ($i = max($this->totalPages - 2, 4); $i <= $this->totalPages; $i++) {
            $pagination[] = $i;
        }

        $this->pagination = $pagination;
    }
};

?>
<div x-data="paginationScroll()" class="flex justify-center items-center mt-4 gap-5 my-5">
    @foreach ($pagination as $pageIndex)
        @if ($pageIndex === -1)
            <span class="px-4 py-2 text-gray-500">...</span>
        @else
            <button
                @click=" scrollToId('product-container')"
                wire:click="setPage({{ $pageIndex }})"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md  {{ $pageIndex == $page ? 'bg-blue-500 text-white' : 'hover:bg-gray-300' }}">
                {{ $pageIndex}}
            </button>
        @endif
    @endforeach
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
