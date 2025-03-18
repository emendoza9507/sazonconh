import CartHook from './cartHook'

const CartUI = (function () {
    // Referencia al elemento que mostrara la cantidad de items
    let cartCountElement = null
    // Refrencia a; elemento que mostrara el total
    let cartTotalElement = null
    // Referencia al elemento que contendra los items del carrito
    let cartItemsContainer = null
    // Referencia al modal del carrito
    let cartModal = null

    /**
     * Inicializa la UI de; carrito
     */
    function initCartUI () {
        if (!document.getElementById('cart-icon')) {
            createCartIcon()
        }

        if (!document.getElementById('cart-modal')) {
            createCartModal()
        }

        cartCountElement = document.getElementById('cart-count')
        cartTotalElement = document.getElementById('cart-total')
        cartItemsContainer = document.getElementById('cart-items')
        cartModal = document.getElementById('cart-modal')

        CartHook.useCart(updateCartUI)

        document.addEventListener('click', function (e) {
            // Toggle del modal del carrito
            if (e.target.closest('#cart-icon')) {
                toggleCartModal()
            }

            // Cerrar modal si se hace click fuera
            if (
                cartModal &&
                cartModal.classList.contains('show') &&
                !e.target.closest('.cart-modal-content') &&
                !e.target.closest('#cart-icon')
            ) {
                closeCartModal()
            }

            // Manejar botones de anadir al carrito
            if (e.target.closest('.add-to-cart')) {
                const button = e.target.closest('.add-to-cart')
                const id = button.dataset.productId
                const name = button.dataset.productName
                const price = button.dataset.productPrice
                const image = button.dataset.plateImage || ''

                addProductToCart({ id, name, price, image })
            }
        })
    }

    function updateCartUI (cartItems) {
        if (cartCountElement) {
            const count = CartHook.getCartCount()
            cartCountElement.textContent = count
            cartCountElement.classList.toggle('hidden', count === 0)
        }

        // Actualiza total
        if (cartTotalElement) {
            const total = CartHook.getCartTotal()
            cartTotalElement.textContent = `$${total.toFixed(2)}`
        }

        if (cartItemsContainer) {
            renderCartItems(cartItems)
        }
    }

    /**
     * Renderiza los items del carrito
     */
    function renderCartItems (cartItems) {
        cartItemsContainer.innerHTML = ''

        if (cartItems.length === 0) {
            cartItemsContainer.innerHTML = `
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <p class="mt-4 text-gray-600">Tu carrito está vacío</p>
                </div>
            `
            return
        }

        cartItems.forEach(item => {
            const itemElement = document.createElement('div')
            itemElement.className =
                'flex items-center p-4 border-b border-gray-200'
            itemElement.innerHTML = `
                <div class="w-16 h-16 rounded overflow-hidden mr-4">
                    <img src="${
                        item.image || '/images/placeholder-dish.jpg'
                    }" alt="${item.name}" class="w-full h-full object-cover">
                </div>
                <div class="flex-1">
                    <h4 class="font-medium text-gray-800">${item.name}</h4>
                    <div class="flex items-center justify-between mt-2">
                        <div class="text-green-600">$${parseFloat(
                            item.price
                        ).toFixed(2)}</div>
                        <div class="flex items-center">
                            <button class="cart-qty-btn minus px-2 py-1 bg-gray-200 rounded-l" data-id="${
                                item.id
                            }">-</button>
                            <span class="px-4 py-1 bg-gray-100">${
                                item.quantity
                            }</span>
                            <button class="cart-qty-btn plus px-2 py-1 bg-gray-200 rounded-r" data-id="${
                                item.id
                            }">+</button>
                        </div>
                    </div>
                </div>
                <button class="cart-remove-btn ml-4 text-gray-500 hover:text-red-500" data-id="${
                    item.id
                }">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `

            cartItemsContainer.appendChild(itemElement)
        })

        cartItemsContainer.querySelectorAll('.cart-qty-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id
                const currentItems = CartHook.getCartItems()
                const item = currentItems.find(item => item.id === id)

                if (item) {
                    if (this.classList.contains('plus')) {
                        CartHook.updateQuantity(id, item.quantity + 1)
                    } else {
                        CartHook.updateQuantity(id, item.quantity - 1)
                    }
                }
            });
        });

        cartItemsContainer
            .querySelectorAll('.cart-remove-btn')
            .forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.dataset.id
                    CartHook.removeFromCart(id)
                })
            })

        const footerElement = document.createElement('div')
        footerElement.className = 'p-4 bg-gray-50'
        footerElement.innerHTML = `
            <div class="flex justify-between mb-4">
                <span class="font-medium">Total:</span>
                <span class="font-bold text-green-600">$${CartHook.getCartTotal().toFixed(
                    2
                )}</span>
            </div>
            <button id="checkout-btn" class="w-full py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors">
                Proceder al Pago
            </button>
            <button id="clear-cart-btn" class="w-full mt-2 py-2 text-gray-500 hover:text-gray-700 transition-colors text-sm">
                Vaciar Carrito
            </button>
        `

        cartItemsContainer.appendChild(footerElement)

        //Agregar listeners para los botones del footer
        document
            .getElementById('checkout-btn')
            .addEventListener('click', proceedToCheckout)
        document
            .getElementById('clear-cart-btn')
            .addEventListener('click', clearCart)
    }

    function createCartIcon () {
        const cartIcon = document.createElement('div')
        cartIcon.id = 'cart-icon'
        cartIcon.className =
            'fixed top-4 right-4 bg-white p-3 rounded-full shadow-lg z-50 cursor-pointer hover:bg-gray-100 transition-colors'
        cartIcon.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span id="cart-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden"></span>
        `

        document.body.appendChild(cartIcon)
    }

    function createCartModal () {
        const modal = document.createElement('div');
        modal.id = 'cart-modal';
        modal.style.top = 80 + 'px';
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-end transition-opacity opacity-0 pointer-events-none'
        modal.innerHTML = `
            <div class="cart-modal-content bg-white w-full max-w-md h-full shadow-xl transform translate-x-full transition-transform">
                <div class="flex items-center justify-between p-4 border-b">
                    <h3 class="text-lg font-bold text-gray-800">Tu Carrito</h3>
                    <button id="close-cart-btn" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div id="cart-items" class="overflow-auto h-[calc(100%-6rem)]">
                    <!-- Aquí se renderizarán los items del carrito -->
                </div>
            </div>
        `

        document.body.appendChild(modal)

        // Agregar evento al botón de cerrar
        document
            .getElementById('close-cart-btn')
            .addEventListener('click', closeCartModal)
    }

    function openCartModal () {
        const modal = document.getElementById('cart-modal');
        const content = modal.querySelector('.cart-modal-content');

        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');

        // Pequeño retraso para la animación
        setTimeout(() => {
            content.classList.remove('translate-x-full');
        }, 10);
    }

    /**
     * Cierra el modal del carrito
     */
    function closeCartModal () {
        const modal = document.getElementById('cart-modal')
        const content = modal.querySelector('.cart-modal-content')

        content.classList.add('translate-x-full')

        // Esperar a que termine la animación
        setTimeout(() => {
            modal.classList.add('opacity-0', 'pointer-events-none')
            modal.classList.remove('opacity-100')
        }, 300)
    }

    /**
     * Alterna la visualización del modal
     */
    function toggleCartModal () {
        const modal = document.getElementById('cart-modal')
        if (modal.classList.contains('opacity-0')) {
            openCartModal()
        } else {
            closeCartModal()
        }
    }

    /**
     * Añade un plato al carrito
     */
    function addProductToCart (dish) {
        CartHook.addToCart(dish)

        // Mostrar notificación
        showNotification(`¡${dish.name} añadido al carrito!`)
    }

    /**
     * Vacía el carrito
     */
    function clearCart () {
        if (confirm('¿Estás seguro de que deseas vaciar el carrito?')) {
            CartHook.clearCart()
            showNotification('Carrito vaciado correctamente')
        }
    }

    /**
     * Procede al pago
     */
    function proceedToCheckout () {
        // Aquí puedes redirigir a la página de checkout
        // o implementar un proceso de pago
        window.location.href = '/checkout'
    }

    /**
     * Muestra una notificación
     */
    function showNotification (message, type = 'success') {
        const notification = document.createElement('div')
        notification.className = `fixed notification_card px-6 py-3 rounded-lg shadow-lg transform transition-all duration-500 translate-y-20 opacity-0 z-50 ${
            type === 'success'
                ? 'bg-green-600 text-white'
                : 'bg-red-600 text-white'
        }`
        notification.textContent = message
        document.body.appendChild(notification)

        setTimeout(() => {
            notification.classList.remove('translate-y-20', 'opacity-0')
        }, 100)

        setTimeout(() => {
            notification.classList.add('translate-y-20', 'opacity-0')
            setTimeout(() => {
                notification.remove()
            }, 500)
        }, 3000)
    }

    return {
        init: initCartUI,
        addToCart: addProductToCart,
        openCart: openCartModal,
        closeCart: closeCartModal
    }
})()

export default CartUI;