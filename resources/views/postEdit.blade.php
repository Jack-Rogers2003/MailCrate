<header class = "Page header sticky top-0 bg-white" style = "position:sticky">
    <h1>@livewire('DashboardHeader')</h1>
</header>

<x-app-layout>
    @livewire('post_edit', ['id' => $postID])
</x-app-layout>