<x-app-layout>
    <!-- slider section -->
    <div class=" py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div id="main_slider" class="relative h-[600px]">
                    <div class="carousel-inner">
                        <div class="carousel-item active h-full">
                            <div class="grid md:grid-cols-2 gap-8 items-center h-full">
                                <div class="space-y-6">
                                    <h3 class="text-4xl font-bold text-white">Discover Restaurants<br>That deliver near
                                        You</h3>
                                    <p class="text-gray-300">It is a long established fact that a reader will be
                                        distracted by the readable content of a page when looking at its layout.</p>
                                    <a href="#"
                                        class="uppercase inline-block px-8 py-3 border-2 border-green-600 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-colors">Order
                                        Now</a>
                                </div>
                                <div class="text-center">
                                    <img src="images/burger_slide.png" alt="Burger" class="max-w-full mx-auto" />
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item h-full">
                            <div class="grid md:grid-cols-2 gap-8 items-center h-full">
                                <div class="space-y-6">
                                    <h3 class="text-4xl font-bold text-white">Second Slide Restaurants<br>That deliver
                                        near You</h3>
                                    <p class="text-gray-300">It is a long established fact that a reader will be
                                        distracted by the readable content of a page when looking at its layout.</p>
                                    <a href="#"
                                        class="uppercase inline-block px-8 py-3 border-2 border-green-600 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-colors">Order
                                        Now</a>
                                </div>
                                <div class="text-center">
                                    <img src="images/about-img.jpg" alt="Burger" class="max-w-full mx-auto" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-16 md:bottom-0 left-0 right-0 flex justify-center gap-4">
                        <button title="Previous" class="p-2 h-10 w-10 bg-white rounded-full shadow-lg hover:bg-gray-100"
                            data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </button>
                        <button title="Next" class="p-2 h-10 w-10 bg-white rounded-full shadow-lg hover:bg-gray-100"
                            data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- section -->
    <section class="py-16 bg-gradient-to-b from-brown/30 to-background/40 relative">
        {{-- Menus --}}
        <div class="container mx-auto px-4">
            <div class="text-center relative mb-12">
                <h2 class="text-4xl font-motter tracking-widest font-bold text-white uppercase">{{ __('Our Menus') }}</h2>
                <a href="{{route('menu')}}" class="inline-flex items-center text-green-400 hover:text-green-700">Ver todos</a>
            </div>

            <div class="relative">
                <div class="owl-carousel" data-item-selector=".carousel-item" data-class-item-selector="carousel-item">
                    <!-- Recipe Item 1 -->
                    @foreach ($lastMenus as $menu)
                        <div
                            class="group relative min-h-[400px] rounded-lg overflow-hidden border-green-400 border hover:shadow-2xl hover:shadow-green-500">
                            <div class="h-48">
                                <img src="{{ Storage::url($menu->cover_image) }}"
                                    alt="{{ $menu->name }}-{{ $menu->description }}"
                                    class="h-full w-full mx-auto object-cover"
                                    style="view-transition-name: menu-image-{{ $menu->id }};" />
                            </div>
                            <div class="relative p-4 overflow-hidden">
                                <a href="{{ route('menu.detail', $menu->slug) }}" class="btn-action menu-item-link" data-menu-id="{{ $menu->id }}">
                                    <h3 class="text-[20px] font-motter text-green-400 btn-action">{{ $menu->name }}</h3>
                                </a>
                                <p class="text-[15px] line-clamp-3 text-white border-t border-brown transition-all duration-500">
                                    {{ $menu->description }}</p>
                                {{-- <h4 class="mt-2"><span class="text-blue-600">$</span>{{$menu->price}}</h4> --}}

                            </div>
                            <div class="absolute w-full bottom-0 flex p-4 justify-between items-center">
                                <span class="text-green-400">{{ $menu->price }} {{ __('USD') }}</span>
                                <a href="{{ route('menu.detail', $menu->slug) }}"
                                    class="menu-item-link uppercase inline-block btn-action px-8 py-3 border-2 border-green-600 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-colors"
                                    data-menu-id="{{ $menu->id }}">
                                    {{ __('Order Now') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="">
        <!-- about -->
        <div class="py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 relative">
                    <img src="images/title.png" alt="title" class="mx-auto mb-4" />
                    <h2 class="text-4xl font-motter tracking-wide font-bold text-white uppercase">{{ __('About Our Food & SahzonConh') }}</h2>
                    <p class="mt-4 text-gray-300 italic underline">{{ __('Where work and taste meet.') }}</p>
                </div>

                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6">
                        <h3 class="text-3xl font-bold text-white">{{ __('Best Food') }}</h3>
                        <p class="text-gray-300">{{ __('info.about-us') }}</p>
                        <a href="{{ route('about') }}"
                            class="inline-flex items-center text-green-400 hover:text-green-700">
                            {{ __('Read More') }}
                            <i class="fa fa-long-arrow-right ml-2"></i>
                        </a>
                    </div>
                    <div class="relative">
                        <img src="images/about-img.jpg" alt="About" class="rounded-lg shadow-lg w-full" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="">
        {{-- Blog --}}
        <div class="py-16 relative">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 relative">
                    <img src="images/title.png" alt="title" class="mx-auto mb-4">
                    <h2 class="text-4xl font-bold font-motter tracking-wide text-white uppercase">{{ __('Our Blog') }}</h2>
                    <p class="mt-4 text-gray-300">{{ __('info.our-blog') }}</p>
                    <a href="{{ route('blog') }}" class="inline-flex items-center text-green-400 hover:text-green-700">
                        {{ __('Ver Más') }}
                        <i class="fa fa-long-arrow-right ml-2"></i>
                    </a>
                </div>

                <div class="relative">
                    <div class="owl-carousel" data-item-selector=".blog-item" data-class-item-selector="blog-item">
                        <!-- Blog Item 1 -->
                        @foreach ($lastPosts as $post)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <div class="relative">
                                    <img src="{{ url($post->cover_image) }}" alt="{{ $post->title }}"
                                        class="w-full h-48 object-cover">
                                    <span class="absolute top-4 left-4 bg-white px-3 py-1 rounded-full text-sm">02 FEB
                                        2019</span>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-4">{{ $post->title }}</h3>
                                    <p class="text-gray-600">{!! Str::limit(strip_tags($post->content), 150) !!}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="container mx-auto px-4 relative">
            <div class="text-center mb-12">
                <img src="images/title.png" alt="title" class="mx-auto mb-4" />
                <h2 class="text-4xl font-motter tracking-wide font-bold text-white uppercase">{{ __('Our Client') }}</h2>
            </div>

            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                    <img src="https://api.dicebear.com/9.x/lorelei/svg?seed=Juana" alt="Avatar de Bujer"
                        class="w-24 h-24 rounded-full mx-auto mb-6" />
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">María López</h3>
                    <p class="text-gray-600 mb-6">Desde que comenzamos a trabajar con SahzonConh, nuestra
                        experiencia culinaria ha mejorado notablemente. Los almuerzos son siempre frescos y
                        deliciosos, y el servicio es excepcional. ¡Recomiendo encarecidamente sus servicios a
                        cualquier empresa que busque calidad y conveniencia!</p>
                    <img src="images/client_icon.png" alt="Quote" class="mx-auto" />
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
