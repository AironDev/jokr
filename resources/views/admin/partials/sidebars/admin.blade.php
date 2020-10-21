<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-small.png">
            </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            {{ __('Jokr') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.index', 'dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('ADMIN') }}</p>
                </a>
            </li>

            <li class="{{Route::is('admin.users.index') || Route::is('admin.users.edit') ? 'active' : ''}}">
                <a data-toggle="collapse" aria-expanded="false" href="#laravelExamples">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                            {{ __('Users') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{Route::is('admin.users.index') ? 'active' : ''}}">
                            <a href="{{ route('admin.users.index') }}">
                                <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __(' View Users ') }}</span>
                            </a>
                        </li>
                        <li class="{{Route::is('admin.users.edit', 'airon') ? 'active' : ''}}">
                            <a href="{{ route('admin.users.edit', 'airon') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            
            <li class="{{ $elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('admin.index', 'icons') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'map' ? 'active' : '' }}">
                <a href="{{ route('admin.index', 'map') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>


            <li class="{{ $elementActive == 'rbac' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="false" href="#rbac">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                            {{ __('Rbac') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="rbac">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'rbac' ? 'active' : '' }}">
                            <a href="{{ route('rbac.create', 'rbac') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __('Create') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="{{ $elementActive == 'notifications' ? 'active' : '' }}">
                <a href="{{ route('admin.index', 'notifications') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'tables' ? 'active' : '' }}">
                <a href="{{ route('admin.index', 'tables') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>{{ __('Table List') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'typography' ? 'active' : '' }}">
                <a href="{{ route('admin.index', 'typography') }}">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>{{ __('Typography') }}</p>
                </a>
            </li>
            <li class="active-pro {{ $elementActive == 'upgrade' ? 'active' : '' }} bg-danger">
                <a href="{{ route('admin.index', 'upgrade') }}">
                    <i class="nc-icon nc-spaceship text-white"></i>
                    <p class="text-white">{{ __('Upgrade to PRO') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>