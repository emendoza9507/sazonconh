const CartHook = (function () {
    const STORAGE_KEY = 'restaurant_cart';

    const subscribers = [];

    /**
     * Obtiene los items actuales del carrito desde localStorage
     */
    function getCartItems() {
        const cartData = localStorage.getItem(STORAGE_KEY);
        return cartData ? JSON.parse(cartData) : [];
    }

    /**
     * Guarda los items en localStorage y notifica a los subscritores
     * @param {*} items
     */
    function saveCartItems(items) {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
        notifySubscribers();
    }

    /**
     * Notifica a todos los subscriptores del cambio
     */
    function notifySubscribers() {
        const items = getCartItems();
        subscribers.forEach(callback => callback(items));
    }

    /**
     * Agrega un plato al carrito
     * @param {*} item
     * @returns
     */
    function addToCart(item) {
        const cart = getCartItems();
        const existingItemIndex = cart.findIndex(cartItem => cartItem.id === item.id);

        if(existingItemIndex >= 0) {
            cart[existingItemIndex].quantity += item.quantity || 1;
        } else {
            const newItem = { ...item, quantity: item.quantity || 1 };
            cart.push(newItem);
        }

        saveCartItems(cart);
        return cart;
    }

    /**
     * Actualiza la cantidad de un item
     * @param {*} itemId
     * @param {*} quantity
     */
    function updateQuantity(itemId, quantity) {
        const cart = getCartItems();
        const itemIndex = cart.findIndex(item => item.id === itemId);

        if(itemIndex >= 0) {
            if(quantity <= 0) {
                cart.splice(itemIndex, 1);
            } else {
                cart[itemIndex].quantity = quantity;
            }

            saveCartItems(cart);
        }

        return cart;
    }

    /**
     * Elimina un plato del carrito
     * @param {*} itemId
     * @returns
     */
    function removeFromCart(itemId) {
        const cart = getCartItems();
        const updatedCart = cart.filter(item => item.id !== itemId);

        saveCartItems(updatedCart);
        return updatedCart;
    }

    /**
     * Vacia el carrito
     */
    function clearCart() {
        saveCartItems([]);
        return [];
    }

    /**
     * @returns Calcula el total del carrito
     */
    function getCartTotal() {
        const cart = getCartItems();
        return cart.reduce((total, item) => {
            return total + (parseFloat(item.price) * item.quantity);
        }, 0);
    }

    /**
     * Obtiene la cantidad total de items en el carrito
     * @returns {Number}
     */
    function getCartCount() {
        const cart = getCartItems();
        return cart.reduce((count, item) => count + item.quantity, 0);
    }

    /**
     * Subscribe una function callback para ser notificada de cambios
     * Similar a un hook de React useEffect
     * @param {*} callback
     * @returns
     */
    function useCart(callback) {
        subscribers.push(callback)

        callback(getCartItems());

        return function unsubscribe() {
            const index = subscribers.indexOf(callback);
            if(index !== -1) {
                subscribers.splice(index, 1);
            }
        }
    }

    /**
     * API publica
     */
    return {
        addToCart,
        updateQuantity,
        removeFromCart,
        clearCart,
        getCartItems,
        getCartTotal,
        getCartCount,
        useCart
    }
})();

export default CartHook;