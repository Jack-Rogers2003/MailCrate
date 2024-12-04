<!-- resources/views/layouts/app.blade.php -->
<header class = "Page header sticky top-0 bg-white" style = "position:sticky">
    <h1>@livewire('DashboardHeader')</h1>
</header>

@if(Auth::check())
<x-app-layout>
    @livewire('DashboardLivewire')
</x-app-layout>
@endif


<x-app-layout>
    @livewire('post-componenet')
</x-app-layout>




