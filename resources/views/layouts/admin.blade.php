<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="app.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        :root {
            --primary-bg: #614514;
            --primary-text: #000000;
            --secondary-bg: #FFFFFF;
            --secondary-text: #757575;

            /* Sagdii lang sani kay balikan ra koni -zai */
            --button-text: #291E13;
            --button-hover-text: #6A6A6A;
            --button-selected-text: #CCA841;
            --button-selected-bg: #F7F7F7;
        }

        [data-theme="dark"] {
            --primary-bg: #242424;
            --primary-text: #000000;
            --secondary-bg: #777777;
            --secondary-text: #000000;
        }

        /* [data-theme="light"] {
            --primary-bg: #614514;
            --primary-text: #000000;
            --secondary-bg: #FFFFFF;
            --secondary-text: #000000;
        } */

        [data-theme="rosyred"] {
            --primary-bg: #66070e;
            --primary-text: #000000;
            --secondary-bg: #ffcdcd94;
            --secondary-text: #000000;
        }

        [data-theme="slimegreen"] {
            --primary-bg: #1A5319;
            --primary-text: #000000;
            --secondary-bg: #80AF81;
            --secondary-text: #000000;
        }

        [data-theme="bluesky"] {
            --primary-bg: #008DDA;
            --primary-text: #000000;
            --secondary-bg: #a7cdff;
            --secondary-text: #000000;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--secondary-bg);
            color: var(--secondary-text);
        }

        .bg-primary {
            background-color: var(--primary-bg);
        }

        .text-primary {
            color: var(--primary-text);
        }

        .w-73 {
            width: 18.25rem;
            /* 73 x 0.25rem */
        }

        .ml-73 {
            margin-left: 18.25rem;
            /* 73 x 0.25rem */
        }

        .text-gradient {
            background: linear-gradient(90deg, #614514, #C78E29);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .z-50 {
            z-index: 50;
        }

        .dropdown-item {
            width: 100%;
            padding: 0.5rem 1rem;
            text-align: left;
            display: block;
        }

        .dropdown-item:hover {
            background-color: #f3f3f3;
        }

        /* Custom button styles -zai */
        .button-default {
            color: var(--button-text);
        }

        .button-hover:hover {
            color: var(--button-hover-text);
        }

        .button-selected {
            color: var(--button-selected-text);
            background-color: var(--button-selected-bg);
        }
    </style>

    <script>
        function toggleDropdown() {
            document.getElementById("dropdown").classList.toggle("hidden");
        }

        function setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
            toggleDropdown(); // Hide the dropdown after selection
        }

        function loadTheme() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        }

        window.onload = loadTheme;
    </script>
</head>

<body class="h-screen flex">
    <!-- Sidebar -->
    <div class="bg-white w-73 shadow-lg flex flex-col justify-between fixed h-full">
        <!-- Menu -->
        <div>
            <div class="flex items-center my-5 align-center pl-4">
                <img src="/images/SePhi Final Icon 1.png" class="w-16 h-auto" />
                <h1 class="text-gradient font-semibold text-xl">Text Broadcasting</h1>
            </div>

            <hr class="my-4 border-t-2 border-gray-200 w-full">

            <div class="flex items-center justify-center w-full my-10">
                <img src="{{ Auth::user()->avatar }}" alt="user profile" class="w-10 h-auto rounded-full">
                <p class="text-black pl-2 text-sm font-medium">{{ strtok(Auth::user()->email, '@') }}</p>
                <div class="ml-2 px-2 py-1 h-6 text-black font-semibold text-xs rounded" style="background-color: rgba(204, 168, 65, 0.4);">
                    edu
                </div>
                <div class="relative">
                    <img src="/images/SettingsIcon.png" class="ml-2 w-5 h-5 cursor-pointer" onclick="toggleDropdown()">
                    <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg hidden">
                        <a href="{{ url('logout') }}" class="dropdown-item text-gray-800 hover:bg-gray-200">Logout</a>
                        <hr class="border-t-2 border-gray-200 my-2">
                        <button onclick="setTheme('light')" class="dropdown-item text-gray-800 hover:bg-gray-200">Light Theme</button>
                        <button onclick="setTheme('dark')" class="dropdown-item text-gray-800 hover:bg-gray-200">Dark Theme</button>
                        <button onclick="setTheme('rosyred')" class="dropdown-item text-gray-800 hover:bg-gray-200">Rosy Red</button>
                        <button onclick="setTheme('slimegreen')" class="dropdown-item text-gray-800 hover:bg-gray-200">Slime Green</button>
                        <button onclick="setTheme('bluesky')" class="dropdown-item text-gray-800 hover:bg-gray-200">Blue Sky</button>
                    </div>
                </div>
            </div>

            <hr class="my-4 border-t-2 border-gray-200 w-full">

            <!-- Navigation Links -->
            <ul class="mt-5">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'button-selected' : 'button-default button-hover' }} my-3">
                    <a href="{{ route('admin.dashboard') }}" class="px-10 py-3 flex items-center w-full h-full font-semibold text-lg">
                        <img src="/svg/dashboard.svg" alt="Dashboard Icon" class="w-6 h-6 mr-[1.2rem]">
                        Dashboard
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.messages') ? 'button-selected' : 'button-default button-hover' }} my-3">
                    <a href="{{ route('admin.messages') }}" class="px-10 py-3 flex items-center w-full h-full font-semibold text-lg">
                        <img src="/svg/message.svg" alt="Messages Icon" class="w-6 h-6 mr-[1.2rem]">
                        Messages
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.analytics') ? 'button-selected' : 'button-default button-hover' }} my-3">
                    <a href="{{ route('admin.analytics') }}" class="px-10 py-3 flex items-center w-full h-full font-semibold text-lg">
                        <img src="/svg/analytics.svg" alt="Analytics Icon" class="w-6 h-6 mr-[1.2rem]">
                        Analytics
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.user-management') ? 'button-selected' : 'button-default button-hover' }} my-3">
                    <a href="{{ route('admin.user-management') }}" class="px-10 py-3 flex items-center w-full h-full font-semibold text-lg">
                        <img src="/svg/user.svg" alt="User Management Icon" class="w-6 h-6 mr-[1.2rem]">
                        User Management
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.app-management') ? 'button-selected' : 'button-default button-hover' }} my-3">
                    <a href="{{ route('admin.app-management') }}" class="px-10 py-3 flex items-center w-full h-full font-semibold text-lg">
                        <img src="/svg/app.svg" alt="App Management Icon" class="w-6 h-6 mr-[1.2rem]">
                        App Management
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-gray-200 flex-reverse relative flex-1 ml-73">
        <div class="absolute w-full h-36 shadow-md bg-primary"></div>
        <div class="relative flex-1 p-8">
            <!-- Page Content -->
            <h1 class="text-2xl font-semibold mb-4 text-white">@yield('title')</h1>
            <div class="mt-10">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>