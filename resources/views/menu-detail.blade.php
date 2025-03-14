<x-app-layout>
<section class="bg-background">
    <div class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12 relative">
                <h2 class="text-4xl font-bold text-white">{{ __('Detalles del Menú') }}</h2>
            </div>

            <div class="space-y-6 mb-4">
                <h3 class="text-3xl font-bold text-white">{{ $menu->name }}</h3>
                <p class="text-gray-300">{{ $menu->description }}</p>
            </div>

            <div class="space-y-6 mb-4">
                <h3 class="text-3xl font-bold text-white">{{ __('Platos Incluidos') }}</h3>
                <ul class="list-disc list-inside mt-4 text-gray-300">
                    @foreach ($menu->dishes as $dish)
                        <li>{{ $dish->name }}: {{ $dish->description }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="space-y-6 mb-4">
                <h3 class="text-3xl font-bold text-white">{{ __('Precio') }}</h3>
                <p class="text-gray-300">{{ $menu->price }} {{ __('USD') }}</p>
            </div>
        </div>
    </div>
</section>
</x-app-layout>