<div x-data="{
    isCartOpen: @entangle('isOpen'),
    saveCart(data) {
        localStorage.setItem('restaurant_cart', JSON.stringify(data.items));
    },
    loadCart() {
        const cart = localStorage.getItem('restaurant_cart');
        if (cart) {
            @this.call('syncFromLocalStorage', JSON.parse(cart));
        }
    },
    showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `fixed notification_card px-6 py-3 rounded-lg shadow-lg transform transition-all duration-500 translate-y-20 opacity-0 z-50 ${type === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'}`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.remove('translate-y-20', 'opacity-0')
        }, 100);

        setTimeout(() => {
            notification.classList.add('translate-y-20', 'opacity-0');
            setTimeout(() => {
                notification.remove();
            }, 500)
        }, 3000)
    }
}" x-init="loadCart()" @save-cart.window="saveCart($event.detail)"
    @cart-updated.window="showNotification($event.detail.action === 'added' ? `¡${$event.detail.product} añadido al carrito!` : $event.detail.action === 'removed' ? `${$event.detail.product} eliminado del carrito` : $event.detail.action === 'cleared' ? 'Carrito vaciado correctamente' : 'Carrito actualizado')"
    @cart-error.window="showNotification($event.detail.message, 'error')">
    {{-- Icono del carrito --}}
    <button @click="isCartOpen = !isCartOpen"
        class="relative bg-white p-3 rounded-full shadow-lg cursor-pointer hover:bg-gray-100 transition-colors flex items-center justify-center"
        aria-label="Carrito de compras">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        @if ($totalItems > 0)
            <span
                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                {{ $totalItems }}
            </span>
        @endif
    </button>

    {{-- Modal del carrito --}}
    <div x-show="isCartOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 z-40 flex justify-end" @keydown.escape.window="isCartOpen = false"
        x-cloak>

        {{-- Panel deslizante --}}
        <div x-show="isCartOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="transform translate-x-full" x-transition:enter-end="transform translate-x-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="transform translate-x-0"
            x-transiiton:leave-end="transform translate-x-full"
            class="bg-white w-full max-w-md h-full shadow-lg overflow-hidden flex flex-col">

            {{-- Cabecera --}}
            <div class="flex items-center justify-between p-6 border-b">
                <h3 class="text-2xl font-motter font-bold text-gray-800">Tu Carrito</h3>
                <button @click="isCartOpen = false" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Contenido --}}
            <div class="flex-1 overflow-y-auto">
                @if ($items->isEmpty())
                    <div class="text-center py-16">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>

                        <p class="mt-6 text-gray-500 text-lg">Tu carrito está vacío</p>
                        <p class="mt-2 text-gray-400 text-sm">Añade platos para comenzar tu pedido</p>
                        <button @click="isCartOpen = false"
                            class="mt-6 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            Explorar Menú
                        </button>
                    </div>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach ($items as $index => $item)
                            <li class="flex p-4 hover:bg-gray-50">
                                <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                                    <img class="w-full h-full object-cover" src="{{$item->productable->getCartImage()}}" alt="{{$item->productable->name}}"/>
                                </div>

                                <div class="ml-4 flex-1">
                                    <div class="flex justify-between">
                                        <h4 class="text-sm font-medium text-gray-900">{{$item->productable->getCartName()}}</h4>
                                        <button wire:click="removeItem('{{$item->id}}')" class="text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <p class="mt-1 text-sm text-gray-500">
                                        {{ $item->productable->getCartDetails()['category'] ?? '' }}
                                    </p>

                                    <div class="mt-2 flex justify-between items-center">
                                        <span>${{ number_format($item->productable->getCartPrice(), 2) }}</span>

                                        <div class="flex items-center border rounded-lg overflow-hidden">
                                            <button wire:click="decrement('{{ $item->id }}')" class="px-2 py-1 bg-gray-100 hover:bg-gray-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                                </svg>
                                            </button>
                                            <span class="px-4 py-1 bg-white">{{ $item->quantity }}</span>

                                            <button wire:click="increment('{{ $item->id }}')" type="button" class="px-2 py-1 bg-gray-100 hover:bg-gray-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            @if(!$items->isEmpty())
                <div class="p-4 border-t border-gray-200 bg-gray-50">
                    <div class="space-y-2">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">${{ number_format($this->getSubtotal(), 2) }}</span>
                        </div>

                        @if($tax > 0)
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">Impuestos</span>
                                <span>${{ number_format($tax, 2) }}</span>
                            </div>
                        @endif

                        @if ($deliveryFee > 0)
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">Envío</span>
                                <span>${{ number_format($deliveryFee, 2) }}</span>
                            </div>
                        @endif

                        <div class="border-t pt-2 mt-2 flex justify-between font-medium text-lg">
                            <span>Total</span>
                            <span class="text-green-600">${{ number_format($this->getTotal(), 2) }}</span>
                        </div>
                    </div>

                    <div class="mt-6 space-y-3">
                        <button wire:click="checkout" class="flex items-center justify-center w-full py-3 px-4 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                            Proceder al pedido
                        </button>

                        <button wire:click="clearCart" class="flex items-center justify-center w-full py-3 px-4 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            Vaciar carrito
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
