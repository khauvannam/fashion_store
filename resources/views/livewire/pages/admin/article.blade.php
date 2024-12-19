<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.admin')] class extends component {
    public string $content = '';
}

?>

<div class="py-10">
    <div class="">
        <livewire:components.reusable.ckeditor5 :$content/>
    </div>
    <p>{{$content}}</p>
</div>


