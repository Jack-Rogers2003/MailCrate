<div>
    <h1>Hello! {{$id}}</h1>
    @if(App\Models\Account::where('user_id', Auth::id())->first()->id == $id)
    <h1>This is your profile</h1>
    @endif
</div>
