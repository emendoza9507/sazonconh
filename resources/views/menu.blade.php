<x-app-layout>
    <!-- section -->
    <section class="py-16 bg-background relative">
        <div class="container mx-auto px-4">
            <div class="text-center relative mb-12">
                <h2 class="text-4xl font-bold text-white">Our Recipes</h2>
            </div>

            <div class="relative">
                <div class="owl-carousel grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    @foreach ($lastMenus as $menu)
                        <div class="bg-white group rounded-lg shadow-md overflow-hidden hover:shadow-2xl hover:shadow-background">
                            <div class="h-48 pt-4">
                                <img src="{{Storage::url($menu->cover_image)}}" alt="{{$menu->name}}-{{$menu->description}}" class="h-full mx-auto object-cover" />
                            </div>
                            <div class="p-4 relative overflow-hidden">
                                <a href="{{ route('menu.detail', $menu->slug) }}"><h3 class="text-[40px] font-motter text-gray-800">{{$menu->name}}</h3></a>
                                <p class="text-[15px] border-t border-brown transition-all duration-500">{{$menu->description}}</p>
                                {{-- <h4 class="mt-2"><span class="text-blue-600">$</span>{{$menu->price}}</h4> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-app-layout>