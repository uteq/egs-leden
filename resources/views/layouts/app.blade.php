<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Styles -->
    @moveStyles()
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <livewire:styles />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.js" defer></script>

</head>
<body class="font-sans antialiased" x-data="{ mobileMenuOpen: false, sidebarMenuOpen: true }">

    <div class="h-screen flex overflow-hidden bg-gray-100">

{{--        <?php if (auth()->user()->isAdmin()): ?>--}}
{{--            <x-move-sidebar custom keep-not-custom="false">--}}
{{--                <div class="p-2">--}}
{{--                    <x-move-sidebar.link--}}
{{--                        alt-active="dashboard"--}}
{{--                        href="/dashboard"--}}
{{--                    >--}}
{{--                        Dashboard--}}
{{--                    </x-move-sidebar.link>--}}
{{--                </div>--}}

{{--                <div class="mt-4 pt-4 pb-2 text-white border-t border-red-400">--}}
{{--                    Beheer--}}
{{--                </div>--}}
{{--            </x-move-sidebar>--}}
{{--        <?php endif; ?>--}}

        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div class="relative z-5 flex-shrink-0 flex h-16 bg-white shadow">
{{--                <?php if (auth()->user()->isAdmin()): ?>--}}
{{--                    <x-move-header></x-move-header>--}}
{{--                <?php else: ?>--}}
                    <x-move-header hide-mobile-menu-button hide-search></x-move-header>
<!--                --><?php //endif; ?>
            </div>

            <div class="text-sm bg-gray-200 pl-12 py-2">
                <a href="/dashboard" class="hover:underline flex gap-2 items-center ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Home
                </a>
            </div>

            <main class="flex-1 relative overflow-y-auto focus:outline-none" tabindex="0">
                <div class="pt-2 pb-6 md:py-6">
                    <div class="px-4 sm:px-6 md:px-8">
                        <h1 class="text-2xl font-semibold text-gray-900">
                            {{ $header }}
                        </h1>
                    </div>
                    <div class="mx-auto px-4 sm:px-6 md:px-8">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    @moveScripts()
    <livewire:scripts />
    @stack('scripts')
    @stack('styles')
    @stack('modals')
</body>
</html>
