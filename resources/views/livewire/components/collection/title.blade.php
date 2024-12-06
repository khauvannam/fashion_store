<?php


use Livewire\Volt\Component;

new class extends Component {

    public string $title = '';


};
?>
<div class="container mx-auto">
    {{$title}}
</div>
