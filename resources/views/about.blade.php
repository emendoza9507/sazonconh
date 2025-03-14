<x-app-layout>
    <section class="bg-background">
        <!-- about -->
        <div class="py-16">
            <div class="container mx-auto px-4">
                <<div class="text-center mb-12 relative">
                    <img src="images/title.png" alt="title" class="mx-auto mb-4" />
                    <h2 class="text-4xl font-bold text-white">{{ __('About Our Food & SahzonConh') }}</h2>
                    <p class="mt-4 text-gray-300">{{ __('Where work and taste meet.') }}</p>
                </div>

                <div class="space-y-6 mb-4">
                    <h3 class="text-3xl font-bold text-white">{{ __('Best Food') }}</h3>
                    <p class="text-gray-300">{{ __('info.about-us') }}</p>
                </div>

                <div class="space-y-6 mb-4">
                    <h3 class="text-3xl font-bold text-white">{{ __('How does it work?') }}</h3>
                    <div class="text-gray-300">
                        <ol class="list-decimal list-inside mt-4">
                            <li>Selecciona tu menú semanal desde nuestra plataforma. <span class="text-yellow-300">(Nota: Cada día, entregamos un almuerzo diferente, según el menú acordado para la semana. La entrega se realiza directamente en el centro de trabajo y se mantiene constante durante toda la semana.)</span></li>
                            <ul class="list-disc list-inside ps-4 mt-2 text-gray-300">
                                @foreach ($lastMenus as $menu)
                                    <li><a href="#" class="underline">{{$menu->name}}</a>: <div class="block sm:inline-block">{{$menu->description}}</div></li>
                                @endforeach
                            </ul>
                            <li>El menú es definido para todo el equipo de cada centro de trabajo. Es decir, no se cambia de persona a persona. Todos los trabajadores reciben el mismo menú durante la semana que se elija</li>
                            <li>Realiza tu pedido y confirma la cantidad de personas.</li>
                            <li>Asegúrate de hacer el pedido con al menos 3 días de anticipación o una semana antes de que comience la semana de entrega</li>
                            <li>Recibe tu pedido en la ubicación que elijas, a tiempo y con transporte incluido.</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>