<div>
    <header class = "Page header sticky top-0 bg-white">
        <h1 style="display: flex; justify-content: space-between; width: 100%; margin: 0;">
            <button wire:click='toDashboard' style="text-align: left;">Welcome {{$name}}</span>
            @if ($isAuthenticated)
            <button wire:click='sentToProfile' style="text-align: right; ">Profile</button>
            <button wire:click='logout' style="text-align: right;">Log Out</button>
            @else
            <button wire:click='sentToAuth' style="text-align: right;">Log in/Register</button>
            @endif
        </h1>
    </header>
</div>
