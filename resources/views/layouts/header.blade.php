<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li @if (Route::is('user-list')) class="nav-item active" @else  class="nav-item" @endif>
                    <a class="nav-link" href="{{ url('/user') }}">Users</a>
                </li>
                <li @if (Route::is('notification-list')) class="nav-item active" @else class="nav-item" @endif>
                    <a class="nav-link" href="{{ url('/notification') }}">Notifications</a>
                </li>
                <li @if (Route::is('notification-post')) class="nav-item active" @else class="nav-item" @endif>
                    <a class="nav-link" href="{{ url('/notification/create') }}">Post Notification</a>
                </li>
            </ul>
        </div>
        {{-- vue code --}}
        @if (Route::is('user-dashboard'))
            <div id="vueApp">
                <notification></notification>
            </div>
        @endif
    </nav>
</header>
<style>

</style>
