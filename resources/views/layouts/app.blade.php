<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- awesome fontfamily -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <!-- loader -->
    <div class="fixed inset-0 bg-background z-50" id="loader_bg">
        <div class="flex items-center justify-center h-screen">
            <img src="images/loading.gif" alt="Loading..." class="w-16 h-16" />
        </div>
    </div>

    <div class="relative">
        <!-- sidebar -->
        <div class="fixed inset-y-0 left-0 z-40 w-64 bg-white transform -translate-x-full transition-transform duration-300 ease-in-out"
            id="sidebar">
            <div class="p-4">
                <button id="dismiss" class="float-right text-gray-600 hover:text-gray-800">
                    <i class="fa fa-arrow-left"></i>
                </button>
            </div>

            <nav class="mt-5">
                <ul class="space-y-2 px-4">
                    <li>
                        <a href="index.html" class="block py-2 px-4 text-gray-800 hover:bg-gray-100 rounded-lg">Home</a>
                    </li>
                    <li>
                        <a href="about.html"
                            class="block py-2 px-4 text-gray-800 hover:bg-gray-100 rounded-lg">About</a>
                    </li>
                    <li>
                        <a href="recipe.html"
                            class="block py-2 px-4 text-gray-800 hover:bg-gray-100 rounded-lg">Recipe</a>
                    </li>
                    <li>
                        <a href="blog.html" class="block py-2 px-4 text-gray-800 hover:bg-gray-100 rounded-lg">Blog</a>
                    </li>
                    <li>
                        <a href="contact.html"
                            class="block py-2 px-4 text-gray-800 hover:bg-gray-100 rounded-lg">Contact Us</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="relative">
            <!-- header -->
            <header class="bg-brown shadow-md h-20">
                <div class="container mx-auto px-4 h-full">
                    <div class="flex items-center justify-between h-full">
                        <div class="w-1/4 h-full">
                            <a href="{{ route('welcome') }}" class="block h-full">
                                <img src="images/logo2.png" alt="Logo" class="h-full bg-white" />
                            </a>
                        </div>
                        <div class="w-3/4">
                            <div class="flex items-center justify-end space-x-6">
                                <div class="hidden lg:flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <img src="images/phone_icon.png" alt="phone" class="w-4 h-4 mr-2" />
                                        <a href="tel:+14072575463" class="text-white hover:text-gray-800">+1 (407)
                                            257-5463</a>
                                    </div>
                                    <div class="flex items-center">
                                        <img src="images/mail_icon.png" alt="email" class="w-4 h-4 mr-2" />
                                        <a href="mailto:menu@sahzonconh.com"
                                            class="text-white hover:text-gray-800">menu@sahzonconh.com</a>
                                    </div>
                                    <div class="flex items-center">
                                        <img src="images/location_icon.png" alt="location" class="w-4 h-4 mr-2" />
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
                                <button class="p-2">
                                    <img src="images/search_icon.png" alt="search" class="w-5 h-5" />
                                </button>
                                <button id="sidebarCollapse" class="p-2 lg:hidden">
                                    <img src="images/menu_icon.png" alt="menu" class="w-6 h-6" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main>
                {{ $slot }}
            </main>



            <section class="bg-background">
                <!-- Contact Form -->
                <div class="bg-brown text-white pt-16 relative">
                    <div class="absolute inset-0 -top-10 h-full">
                        <img src="images/helper4.jpg" alt="Background" class="w-full object-cover" />
                    </div>
                    <div class="container mx-auto px-4 relative">
                        <h2 class="text-4xl font-bold text-center mb-12">Request A <span class="text-white">Call
                                Back</span></h2>

                        <div class="grid md:grid-cols-2 gap-12 items-center">
                            <div>
                                <form class="space-y-6">
                                    <div>
                                        <input type="text" name="Name" placeholder="Name"
                                            class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-brown" />
                                    </div>
                                    <div>
                                        <input type="email" name="Email" placeholder="Email"
                                            class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-brown" />
                                    </div>
                                    <div>
                                        <input type="tel" name="Phone" placeholder="Phone"
                                            class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-brown" />
                                    </div>
                                    <div>
                                        <textarea name="Message" placeholder="Message" rows="4"
                                            class="w-full px-4 py-3 bg-white bg-opacity-10 rounded-lg text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-brown"></textarea>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="w-full px-6 py-3 bg-green-700 text-white rounded-lg hover:bg-green-900 transition-colors">
                                            Send
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <img src="images/img.jpg" alt="Contact" class="rounded-lg shadow-lg w-full" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="bg-background">
                <div class="bg-brown text-white relative overflow-hidden">
                    <div class="absolute inset-0 -top-10 h-full">
                        <img src="images/helper5.jpg" alt="Background" class="w-full" />
                    </div>
                    <div class="container mx-auto px-4 relative">
                        <!-- Footer Logo -->
                        <div class="mt-16 text-center">
                            <a href="index.html">
                                <img src="images/logo.png" alt="logo" class="mx-auto h-20 mb-8" />
                            </a>

                            <!-- Navigation Links -->
                            <ul class="flex justify-center space-x-8 mb-12">
                                <li><a href="index.html" class="text-gray-900 hover:text-blue-600">Home</a></li>
                                <li><a href="about.html" class="text-gray-900 hover:text-blue-600">About</a></li>
                                <li><a href="recipe.html" class="text-gray-900 hover:text-blue-600">Recipe</a></li>
                                <li><a href="blog.html" class="text-gray-900 hover:text-blue-600">Blog</a></li>
                                <li><a href="contact.html" class="text-gray-900 hover:text-blue-600">Contact us</a>
                                </li>
                            </ul>

                            <!-- Newsletter -->
                            <div class="max-w-md mx-auto relative">
                                <h3 class="text-2xl font-bold mb-4">Newsletter</h3>
                                <form class="flex space-x-4">
                                    <input type="email" placeholder="Your email"
                                        class="flex-1 px-4 py-2 bg-white bg-opacity-10 rounded-lg text-white placeholder-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500" />
                                    <button type="submit"
                                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                        Subscribe
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Copyright -->
                    <div class="mt-16 py-4 border-t border-gray-300 relative">
                        <div class="container mx-auto px-4 text-center text-white">
                            <p>© 2019 All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden" id="overlay"></div>



    @stack('modals')

    @livewireScripts

    <!-- Scripts -->
    <script>
        // Sidebar functionality
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            const dismissButton = document.getElementById('dismiss');
            const sidebarCollapse = document.getElementById('sidebarCollapse');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }

            sidebarCollapse.addEventListener('click', openSidebar);
            dismissButton.addEventListener('click', closeSidebar);
            overlay.addEventListener('click', closeSidebar);
        });

        // Carousel functionality
        class Carousel {
            constructor(element) {
                this.element = element;
                this.items = Array.from(element.querySelectorAll('.carousel-item'));
                this.totalItems = this.items.length;
                this.currentIndex = 0;

                // Set up controls
                const prevButton = element.querySelector('[data-slide="prev"]');
                const nextButton = element.querySelector('[data-slide="next"]');

                if (prevButton) prevButton.addEventListener('click', () => this.prev());
                if (nextButton) nextButton.addEventListener('click', () => this.next());

                // Initial setup
                this.showItem(0);
            }

            showItem(index) {
                this.items.forEach(item => {
                    item.classList.remove('active');
                    item.style.display = 'none';
                });

                this.items[index].classList.add('active');
                this.items[index].style.display = 'block';
            }

            next() {
                this.currentIndex = (this.currentIndex + 1) % this.totalItems;
                this.showItem(this.currentIndex);
            }

            prev() {
                this.currentIndex = (this.currentIndex - 1 + this.totalItems) % this.totalItems;
                this.showItem(this.currentIndex);
            }
        }

        // Recipe carousel functionality
        class RecipeCarousel {
            constructor(element) {
                this.container = element;
                this.items = Array.from(element.children);
                this.currentIndex = 0;
                this.itemsPerView = {
                    mobile: 1,
                    tablet: 2,
                    desktop: 5
                };

                this.setupResponsive();
                window.addEventListener('resize', () => this.setupResponsive());
            }

            setupResponsive() {
                const width = window.innerWidth;
                let itemsToShow;

                if (width < 600) {
                    itemsToShow = this.itemsPerView.mobile;
                } else if (width < 1000) {
                    itemsToShow = this.itemsPerView.tablet;
                } else {
                    itemsToShow = this.itemsPerView.desktop;
                }

                this.items.forEach(item => {
                    item.style.display = 'none';
                });

                for (let i = 0; i < itemsToShow; i++) {
                    const index = (this.currentIndex + i) % this.items.length;
                    this.items[index].style.display = 'block';
                }
            }
        }

        // Initialize carousels when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize main slider
            const mainSlider = new Carousel(document.getElementById('main_slider'));

            // Initialize recipe carousel
            const recipeCarousel = new RecipeCarousel(
                document.querySelector('.owl-carousel')
            );

            // Loader functionality
            const loader = document.getElementById('loader_bg');
            window.addEventListener('load', function() {
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 1000);
            });
        });
    </script>
</body>

</html>
