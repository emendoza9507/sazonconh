<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="view-transition" content="same-origin">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/carousel.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased ">
    <div class="h-[100vh] w-full fixed top-0 inset-0 bg-gradient-to-b from-background to-brown">

    </div>
    <x-banner />

    <!-- loader -->
    @if(request()->is('welcome'))
        <div class="fixed inset-0 bg-background z-50" id="loader_bg">
            <div class="flex items-center justify-center h-screen">
                <img id="loader_logo" src="{{ asset('images/logo2.png') }}" alt="Loading..." class="w-16 h-16 animate-ping" />
            </div>
        </div>
    @endif

    <div class="relative">
        <!-- sidebar -->
        <div class="fixed inset-y-0 left-0 z-[101] w-64 bg-white transform -translate-x-full transition-transform duration-300 ease-in-out"
            id="sidebar">
            <div class="p-4">
                <button id="dismiss" class="float-right text-gray-600 hover:text-gray-800">
                    <i class="fa fa-arrow-left"></i>
                </button>
            </div>

            <nav class="mt-5">
                <ul class="space-y-2 px-4">
                    <li>
                        <a href="{{ route('welcome') }}"
                            class="block py-2 px-4 text-gray-800 hover:bg-gray-100 rounded-lg">
                            {{ __('Home') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}"
                            class="block py-2 px-4 text-gray-800 hover:bg-gray-100 rounded-lg">
                            {{ __('About us') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('menu') }}"
                            class="block py-2 px-4 text-gray-800 hover:bg-gray-100 rounded-lg">
                            {{ __('Menus') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog') }}"
                            class="block py-2 px-4 text-gray-800 hover:bg-gray-100 rounded-lg">
                            {{ __('Blog') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                            class="block py-2 px-4 text-gray-800 hover:bg-gray-100 rounded-lg">
                            {{ __('Contact Us') }}
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="relative">
            <!-- header -->
            <header class="sticky bottom-0 top-0 z-[100] bg-brown shadow-md h-20">
                <div class="container mx-auto px-4 h-full">
                    <div class="flex items-center justify-between h-full">
                        <div class="h-full">
                            <a id="nav_logo_container" href="{{ route('welcome') }}" class="block w-20 h-full">
                                <img id="nav_logo" src="{{ asset('images/logo2.png') }}" alt="Logo" class="h-full " />
                            </a>
                        </div>
                        <div class="w-full">
                            <div class="flex items-center justify-end space-x-6">
                                <div class="hidden lg:flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/phone_icon.png') }}" alt="phone"
                                            class="w-4 h-4 mr-2" />
                                        <a href="tel:+14072575463" class="text-white hover:text-gray-800">+1 (407)
                                            257-5463</a>
                                    </div>
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/mail_icon.png') }}" alt="email"
                                            class="w-4 h-4 mr-2" />
                                        <a href="mailto:menu@sahzonconh.com"
                                            class="text-white hover:text-gray-800">menu@sahzonconh.com</a>
                                    </div>
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/location_icon.png') }}" alt="location"
                                            class="w-4 h-4 mr-2" />
                                        <a href="https://www.google.com/maps/place/The+Green+House/@28.450656,-81.349815,15z/data=!4m2!3m1!1s0x88dd84835d232003:0x99dabb6f181cec03"
                                            class="text-white hover:text-gray-800">104 New york, USA</a>
                                    </div>
                                </div>
                                <div class="hidden md:flex items-center  space-x-2">
                                    <a href="#"
                                        class="px-6 py-2.5 bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-medium rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">Login</a>
                                    <a href="#"
                                        class="px-6 py-2.5 bg-white text-green-600 text-sm font-medium rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 border border-transparent hover:border-indigo-100">Register</a>
                                </div>
                                {{-- <button class="p-2">
                                    <img src="{{ asset('images/search_icon.png') }}" alt="search" class="w-5 h-5" />
                                </button> --}}
                                {{-- <button id="cart-icon" class="relative bg-white p-3 rounded-full shadow-lg z-50 cursor-pointer hover:bg-gray-100 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <span id="cart-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">0</span>
                                </button> --}}
                                @livewire('cart')
                                <button id="sidebarCollapse" class="p-2 lg:hidden">
                                    <img src="{{ asset('images/menu_icon.png') }}" alt="menu" class="w-6 h-6" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main>
                {{ $slot }}
            </main>

            <!-- Contact Form -->
            <section class="text-white pt-16 relative">
                <div class="container mx-auto px-4 relative">
                    <h2 class="text-4xl font-bold font-motter text-center mb-12 uppercase">
                        {{ __('Request A Call Back') }}
                    </h2>

                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div>
                            <form class="space-y-6">
                                <div>
                                    <input type="text" name="Name" placeholder="{{ __('Name') }}"
                                        class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-brown" />
                                </div>
                                <div>
                                    <input type="email" name="Email" placeholder="{{ __('Email') }}"
                                        class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-brown" />
                                </div>
                                <div>
                                    <input type="tel" name="Phone" placeholder="{{ __('Phone') }}"
                                        class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-brown" />
                                </div>
                                <div>
                                    <textarea name="Message" placeholder="{{ __('Message') }}" rows="4"
                                        class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-brown"></textarea>
                                </div>
                                <div>
                                    <button type="submit"
                                        class="w-full px-6 py-3 bg-green-700 text-white rounded-lg hover:bg-green-900 transition-colors">
                                        {{ __('Send') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div>
                            <img src="{{ asset('images/img.jpg') }}" alt="Contact"
                                class="rounded-lg shadow-lg w-full" />
                        </div>
                    </div>
                </div>
            </section>

            <footer class=" text-white relative overflow-hidden">
                {{-- <div class="absolute inset-0 -top-10 h-full">
                    <img src="{{ asset('images/helper5.jpg') }}" alt="Background" class="w-full" />
                </div> --}}
                <div class="container mx-auto px-4 relative">
                    <!-- Footer Logo -->
                    <div class="mt-16 text-center">
                        <a href="{{ route('welcome') }}">
                            <img src="{{ asset('images/logo2.png') }}" alt="logo" class="mx-auto h-20 mb-8" />
                        </a>

                        <!-- Navigation Links -->
                        <ul
                            class="flex md:flex-row flex-col justify-center justify-items-center items-center md:space-x-8 mb-12">
                            <li><a href="{{ route('welcome') }}"
                                    class="text-white text-xl uppercase hover:text-green-600">{{ __('Home') }}</a>
                            </li>
                            <li><a href="{{ route('about') }}"
                                    class="text-white text-xl uppercase hover:text-green-600">{{ __('About us') }}</a>
                            </li>
                            <li><a href="{{ route('menu') }}"
                                    class="text-white text-xl uppercase hover:text-green-600">{{ __('Menus') }}</a>
                            </li>
                            <li><a href="{{ route('blog') }}"
                                    class="text-white text-xl uppercase hover:text-green-600">{{ __('Blog') }}</a>
                            </li>
                            <li><a href="{{ route('contact') }}"
                                    class="text-white text-xl uppercase hover:text-green-600">{{ __('Contact Us') }}</a>
                            </li>
                        </ul>

                        <!-- Newsletter -->
                        <div class="max-w-md mx-auto relative">
                            <h3 class="text-2xl font-bold mb-4">{{ __('Newsletter') }}</h3>
                            <form class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                                <input type="email" placeholder="Your email"
                                    class="flex-1 px-4 py-2 bg-white bg-opacity-10 rounded-lg text-white placeholder-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500" />
                                <button type="submit"
                                    class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    {{ __('Subscribe') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="mt-16 py-4 border-t border-gray-300 relative">
                    <div class="container mx-auto px-4 text-center text-white">
                        <p>© 2019 {{ __('All Rights Reserved') }}.</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" id="overlay"></div>



    @stack('modals')


    @livewireScripts

    @stack('scripts')
</body>

</html>
