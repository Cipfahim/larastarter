<div class="list-group">
    <a href="{{ route('app.settings.index') }}" class="list-group-item list-group-item-action {{ Route::is('app.settings.index') ? 'active' : ''  }}">
        General
    </a>
    <a href="{{ route('app.settings.logo.index') }}" class="list-group-item list-group-item-action {{ Route::is('app.settings.logo.index') ? 'active' : ''  }}">
        Logo
    </a>
    <a href="{{ route('app.settings.mail.index') }}" class="list-group-item list-group-item-action {{ Route::is('app.settings.mail.index') ? 'active' : ''  }}">
        Mail
    </a>
</div>
