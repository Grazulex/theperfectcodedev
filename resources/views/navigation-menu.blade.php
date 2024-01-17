<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center shrink-0">
                <a href="{{ route('homepage') }}">
                    <x-application-mark class="block w-auto h-9" />
                </a>
            </div>
            <div class="flex">
                <div class="flex">
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('homepage') }}" :active="request()->routeIs('homepage')">
                            {{ __('Homepage') }}
                        </x-nav-link>
                    </div>
                    @if (Auth::check())
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link href="{{ route('pages.new') }}" :active="request()->routeIs('pages.new')">
                                {{ __('New') }}
                            </x-nav-link>
                        </div>
                    @endif

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('pages.top') }}" :active="request()->routeIs('pages.top')">
                            {{ __('Top 10') }}
                        </x-nav-link>
                    </div>

                    @if (Auth::check())
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <x-nav-link href="{{ route('pages.my') }}" :active="request()->routeIs('pages.my')">
                                {{ __('My codes') }}
                            </x-nav-link>
                        </div>
                    @endif
                </div>

                @if (Auth::check())
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <!-- Teams Dropdown -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="relative ms-3">
                            <x-dropdown align="right" width="60">
                                <x-slot name="trigger">
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700">
                                            {{ Auth::user()->currentTeam->name }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        </button>
                                    </span>
                                </x-slot>

                                <x-slot name="content">
                                    <div class="w-60">
                                        <!-- Team Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            {{ __('Manage Team') }}
                                        </div>

                                        <!-- Team Settings -->
                                        <x-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            {{ __('Team Settings') }}
                                        </x-dropdown-link>

                                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                            <x-dropdown-link href="{{ route('teams.create') }}">
                                                {{ __('Create New Team') }}
                                            </x-dropdown-link>
                                        @endcan

                                        <!-- Team Switcher -->
                                        @if (Auth::user()->allTeams()->count() > 1)
                                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Switch Teams') }}
                                            </div>

                                            @foreach (Auth::user()->allTeams() as $team)
                                                <x-switchable-team :team="$team" />
                                            @endforeach
                                        @endif
                                    </div>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endif

                    <!-- Settings Dropdown -->
                    <div class="relative ms-3">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                    <button class="flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300">
                                        <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                    </button>
                                @else
                                    <span class="inline-flex rounded-md">
                                        <button type="button" class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700">
                                            {{ Auth::user()->name }}

                                            <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        </button>
                                    </span>
                                @endif
                            </x-slot>

                            <x-slot name="content">
                                <!-- Account Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Account') }}
                                </div>

                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-dropdown-link>
                                @endif

                                <div class="border-t border-gray-200 dark:border-gray-600"></div>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf

                                    <x-dropdown-link href="{{ route('logout') }}"
                                             @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
                @else
                <div class="flex">
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                            {{ __('Login') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                            {{ __('Register') }}
                        </x-nav-link>
                    </div>
                </div>
                @endif

                <!-- Hamburger -->
                <div class="flex items-center -me-2 sm:hidden">
                    <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                        <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <button class="self-center ml-4" @click="switchOn = ! switchOn; switchTheme()" type="button">
                    <label class="relative p-2 cursor-pointer" for="light-switch">
                        <svg class="dark:hidden" width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21 20" fill="none">>
                            <path d="M19.1447 13.2501C18.1081 13.6667 16.9761 13.8959 15.7905 13.8959C10.82 13.8959 6.79053 9.8665 6.79053 4.89594C6.79053 3.71036 7.01977 2.57833 7.43634 1.54175C4.12701 2.87167 1.79053 6.11095 1.79053 9.89594C1.79053 14.8665 5.81996 18.8959 10.7905 18.8959C14.5755 18.8959 17.8148 16.5595 19.1447 13.2501Z" stroke="#27395E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <svg class="hidden dark:block" width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 29 29" fill="none">
                        <path d="M14.4678 1.09375V2.55208M14.4678 25.8854V27.3438M27.5928 14.2188H26.1344M2.80111 14.2187H1.34277M23.7485 23.4995L22.7174 22.4683M6.21819 5.96917L5.187 4.93797M23.7486 4.93805L22.7174 5.96925M6.21827 22.4684L5.18707 23.4996M20.3011 14.2188C20.3011 17.4404 17.6894 20.0521 14.4678 20.0521C11.2461 20.0521 8.63444 17.4404 8.63444 14.2188C8.63444 10.9971 11.2461 8.38542 14.4678 8.38542C17.6894 8.38542 20.3011 10.9971 20.3011 14.2188Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </label>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('homepage') }}" :active="request()->routeIs('homepage')">
                {{ __('Homepage') }}
            </x-responsive-nav-link>
        </div>
        @if (Auth::check())
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('pages.new') }}" :active="request()->routeIs('pages.new')">
                    {{ __('New') }}
                </x-responsive-nav-link>
            </div>
        @endif

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('pages.top') }}" :active="request()->routeIs('pages.top')">
                {{ __('Top 10') }}
            </x-responsive-nav-link>
        </div>

        @if (Auth::check())
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link href="{{ route('pages.my') }}" :active="request()->routeIs('pages.my')">
                    {{ __('My codes') }}
                </x-responsive-nav-link>
            </div>
        @endif

        <!-- Responsive Settings Options -->
        @if (Auth::check())
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="flex items-center px-4">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="shrink-0 me-3">
                            <img class="object-cover w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                        </div>
                    @endif

                    <div>
                        <div class="text-base font-medium text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <!-- Account Management -->
                    <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                            {{ __('API Tokens') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-responsive-nav-link href="{{ route('logout') }}"
                                       @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                    <!-- Team Management -->
                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                            {{ __('Team Settings') }}
                        </x-responsive-nav-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                {{ __('Create New Team') }}
                            </x-responsive-nav-link>
                        @endcan

                        <!-- Team Switcher -->
                        @if (Auth::user()->allTeams()->count() > 1)
                            <div class="border-t border-gray-200 dark:border-gray-600"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" component="responsive-nav-link" />
                            @endforeach
                        @endif
                    @endif
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endif
    </div>
</nav>
