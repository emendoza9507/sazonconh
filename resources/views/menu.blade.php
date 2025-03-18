<x-app-layout>
    <!-- section -->
    <section class="py-16 bg-gradient-to-b from-brown/30 to-background/40 relative">
        {{-- Menus --}}
        <div class="container mx-auto px-4">
            <div class="text-center relative mb-12">
                <h2 class="text-4xl font-motter tracking-widest font-bold text-white uppercase">{{ __('Our Menus') }}
                </h2>
            </div>

            <div class="relative">
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                    <!-- Recipe Item 1 -->
                    @foreach ($menus as $menu)
                        <div
                            class="grid grid-cols-12 p-4 rounded-lg overflow-hidden bg-brown/50 border-green-400 hover:border hover:shadow-2xl hover:shadow-green-500">
                            <div class="h-48 col-span-full md:col-span-3 xl:col-span-4">
                                <img src="{{ Storage::url($menu->cover_image) }}"
                                    alt="{{ $menu->name }}-{{ $menu->description }}"
                                    class="h-full w-full rounded-2xl mx-auto object-cover"
                                    style="view-transition-name: menu-image-{{ $menu->id }};" />
                            </div>
                            <div class="relative col-span-full md:col-span-6 xl:col-span-8 p-4 overflow-hidden">
                                <h3 class="text-[20px] font-motter text-green-400">
                                    <a href="{{ route('menu.detail', $menu->slug) }}" class="menu-item-link"
                                        data-menu-id="{{ $menu->id }}">
                                        {{ $menu->name }}
                                    </a>
                                </h3>
                                <p class="text-[15px] text-white border-t border-brown transition-all duration-500">
                                    {{ $menu->description }}</p>
                                {{-- <h4 class="mt-2"><span class="text-blue-600">$</span>{{$menu->price}}</h4> --}}

                            </div>
                            <div
                                class="w-full col-span-full bottom-0 grid grid-cols-2 md:col-span-3 xl:col-span-full p-4 justify-between items-center">
                                <span class=" col-span-full xl:col-span-1 text-green-400">{{ $menu->price }}
                                    {{ __('USD') }}</span>
                                <a href="{{ route('menu.detail', $menu->slug) }}"
                                    class="menu-item-link col-span-full xl:col-span-1  uppercase inline-block btn-action px-8 py-3 border-2 border-green-600 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-colors"
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
</x-app-layout>
