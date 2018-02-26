<b-navbar toggleable="md" type="dark" variant="dark" class="mb-5">
    <div class="container">
        <b-nav-toggle target="header-collapse"></b-nav-toggle>
        <div class="d-flex align-items-center justify-content-around">
            <a class="navbar-brand" href="/">
                {{ config('app.name') }}
            </a>
        </div>
        
        @if(Auth::check())
            <b-collapse is-nav id="header-collapse">
                <b-navbar-nav>
                    <b-nav-item href="{{ route('dashboard') }}">Dashboard</b-nav-item>
                </b-navbar-nav>
                
                <b-nav is-nav-bar class="ml-auto">
                    <b-nav-item-dropdown text="Hello, {{ auth()->user()->name }}" right>
                        <logout-button csrf="{{ csrf_token() }}"></logout-button>
                    </b-nav-item-dropdown>
                </b-nav>
            </b-collapse>
        @endif
    </div>
</b-navbar>
