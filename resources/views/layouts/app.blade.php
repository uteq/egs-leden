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

        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <div class="relative z-5 flex h-16 bg-white shadow items-center">
                <div class="max-w-5xl mx-auto flex flex-1 items-center">
                    <?php if (auth()->user()->isAdmin()): ?>
                        <div class="ml-4 md:ml-0 flex gap-8">
                            <a class="text-blue-500 hover:underline h-full" href="/dashboard">Leden & vaste bezoekers</a>
                            <a class="text-blue-500 hover:underline h-full" href="{{ route('import-members') }}">Leden importeren</a>
                        </div>
                    <?php endif; ?>

                    <x-move-header hide-mobile-menu-button hide-search></x-move-header>
                </div>
            </div>

            <main class="flex-1 relative overflow-y-auto focus:outline-none" tabindex="0">
                <div class="pt-2 pb-6 md:py-6">
                    <div class="px-4 sm:px-6 md:px-8">
                        <h1 class="text-2xl font-semibold text-gray-900">
                            {{ $header ?? null }}
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
