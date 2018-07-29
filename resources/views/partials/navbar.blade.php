 <div class="ontop">
        <ul class="navigation menu menu-centered expanded">
            <li class="menu-text show-for-medium appname">Loan Management System</li>
            @auth
                <li>

                    <i class="fa fa-user fa-4x" aria-hidden="true"></i>

                </li>

                <li><a class="dropdown-item logout" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form  id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form></li>

            @endauth

        </ul>

    </div>