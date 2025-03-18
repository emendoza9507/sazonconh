<x-app-layout>
    <section class="py-4">
        <div class="flex justify-center max-h-[300px]">
            <img class="h-full rounded-lg" src="{{ Storage::url($menu->cover_image) }}" alt="{{ $menu->description }}"
                style="view-transition-name: menu-image-{{ $menu->id }};">
        </div>
        <div class="py-8">
            <div class="container mx-auto px-4">

                <div class="text-center space-y-6 mb-4">
                    <h3 class="text-3xl font-motter tracking-wide font-bold text-white">{{ $menu->name }}</h3>
                    <div class="text-green-400 uppercase text-sm">
                        <a href="{{ route('menu') }}" class="menu-item-link"
                            data-menu-id="{{ $menu->id }}">MENU'S</a>
                        <span>></span>
                        <span>Detalles del menu</span>
                    </div>
                    <p class="text-gray-300">{{ $menu->description }}</p>
                </div>

                <div class="background-images">
                    @foreach ($menu->plates as $plate)
                        <div class="plate-item-bg{{ $loop->index + 1 }}">

                        </div>
                    @endforeach
                </div>

                <div class="plate-list-container  relative mb-4">
                    <div x-data="{ currentplate: null }" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($menu->plates as $plate)
                            <div
                                class="bg-gradient-to-bl from-background/70 to-brown  mb-4 group rounded-xl shadow-xl overflow-hidden hover:shadow-2xl hover:shadow-green-500/30 transition-all duration-300 transform hover:-translate-y-1">

                                <!-- Badge de categoría -->
                                <div class="absolute top-3 left-3 z-10">
                                    <span class="px-3 py-1 text-xs font-semibold bg-green-500 text-white rounded-full">
                                        {{ $plate->category->name ?? 'Especial' }}
                                    </span>
                                </div>

                                <!-- Imagen con overlay y efecto hover -->
                                <div class="relative h-56 overflow-hidden">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent z-[1] opacity-50 group-hover:opacity-70 transition-opacity">
                                    </div>
                                    <img src="{{ Storage::url($plate->cover_image) }}" alt="{{ $plate->name }}"
                                        class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110"
                                        style="view-transition-name: plate-image-{{ $plate->id }};" />

                                    <!-- Precio flotante -->
                                    <div class="absolute top-3 right-3 z-10">
                                        <span
                                            class="flex items-center justify-center h-14 w-14 bg-white shadow-lg rounded-full text-green-600 font-bold">
                                            ${{ number_format($plate->price, 2) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Contenido -->
                                <div class="p-6 relative">
                                    <a href="" class="plate-link" data-plate-id="{{ $plate->id }}">
                                        <h3
                                            class="text-xl drop-shadow-[0px_0px_4px_white] font-motter text-background  transition-colors">
                                            {{ $plate->name }}
                                        </h3>
                                    </a>

                                    <div class="mt-2 h-px w-16 bg-green-500"></div>

                                    <p class="mt-3 text-gray-300 text-sm line-clamp-2">
                                        {{ $plate->description }}
                                    </p>

                                    <!-- Detalles adicionales como iconos -->
                                    <div class="mt-4 flex items-center gap-4 text-xs text-gray-500">
                                        @if ($plate->preparation_time)
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $plate->preparation_time }} min
                                            </div>
                                        @endif

                                        @if ($plate->calories)
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                                </svg>
                                                {{ $plate->calories }} cal
                                            </div>
                                        @endif

                                        <!-- Etiquetas como vegetariano, picante, etc. -->
                                        @if ($plate->is_vegetarian)
                                            <div class="flex items-center text-green-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Veg
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Botones de acción -->
                                    <div class="mt-6 flex justify-between items-center">

                                        <a href="{{ route('plate.detail', $plate) }}"
                                           class="text-sm text-green-600 hover:text-green-800 font-medium flex items-center plate-link"
                                           data-plate-id="{{ $plate->id }}">
                                            Ver detalles
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>

                                        <button @click="$dispatch('addToCart', {productId: {{$plate->id}} })" class="add-to-cart p-2 rounded-full bg-green-100 text-green-600 hover:bg-green-600 hover:text-white transition-colors"
                                                >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- <div class="text-center space-y-6 mb-4">
                    <h3 class="text-3xl font-bold text-white">{{ __('Precio') }}</h3>
                    <p class="text-gray-300">{{ $menu->price }} {{ __('USD') }}</p>
                </div> --}}
            </div>
        </div>
    </section>

    {{-- @push('scripts')
        <script>
            //Plates List
        </script>
    @endpush --}}
</x-app-layout>
