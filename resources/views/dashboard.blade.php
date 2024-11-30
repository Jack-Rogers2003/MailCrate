<!-- resources/views/layouts/app.blade.php -->
<header class = "Page header sticky top-0 bg-white">
    <h1>@livewire('DashboardHeader')</h1>
</header>

<x-app-layout>
    @livewire('DashboardLivewire')
</x-app-layout>
