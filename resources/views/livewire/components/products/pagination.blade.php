<?php


use Livewire\Volt\Component;


new class extends Component {
    public int $totalPages;
    public int $page = 0;

    public function setPage(int $page): void
    {
        $this->page = $page;
        $this->dispatch('page-updated', currentPage: $this->page)->to('pages.products');
    }
};

?>
<div x-data="paginationScroll()" class="flex justify-center items-center mt-4 gap-5 my-5">
    @for ($pageIndex = 0; $pageIndex < $totalPages; $pageIndex++)
        <button
            @click=" scrollToId('product-container')"
            wire:click="setPage({{ $pageIndex }})"
            class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 {{ $pageIndex == $page ? 'bg-blue-500 text-white' : '' }}">
            {{ $pageIndex + 1 }}
        </button>
    @endfor
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
