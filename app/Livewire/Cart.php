<?php

namespace App\Livewire;

use App\Interfaces\Product;
use App\Models\CartItem;
use App\Models\Plate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Cart extends Component
{
    /** @var Collection<CartItem> */
    public Collection $items;
    public bool $isOpen = false;
    public float $subtotal = 0;
    public float $tax = 0;
    public float $deliveryFee = 0;
    public float $total = 0;


    protected $listeners = [
        'addToCart' => 'addProduct',
        'updateCartItemQuantity' => 'updateQuantity',
        'removeCartItem' => 'removeItem',
        'cartUpdated' => '$refresh',
        'syncCartFromLocalStorage' => 'syncFromLocalStorage'
    ];

    public function mount()
    {
        //El carrito se sinzonizara desde localStorage desde el frontend
        $this->items = new Collection([]);
    }

    public function render()
    {
        return view('livewire.cart', [
            'totalItems' => $this->getTotalItems(),
            'subtotal' => $this->getSubtotal(),
            'total' => $this->getTotal()
        ]);
    }

    public function toggleCart()
    {
        $this->isOpen = !$this->isOpen;
    }

    public function addProduct($productId, $type = Plate::PRODUCT_TYPE, $quantity = 1)
    {
        $product = $this->findProduct($productId, $type);

        if(!$product) {
            $this->dispatch('cart-error', [
                'message' => 'Producto no encontrado'
            ]);
            return;
        }

        $existingItem = $this->items->first(function (CartItem $item) use ($product) {
            return $item->details['id'] === $product->getCartId();
        });

        if($existingItem) {
            $existingItem->incrementQuantity($quantity);
            $existingItem->save();
        } else {
            $this->items->push(CartItem::fromProduct($product, $quantity));
        }

        $this->saveCartToLocalStorage();

        $this->dispatch('cart-updated', [
            'action' => 'added',
            'product' => $product->getCartName(),
            'cartCount' => $this->getTotalItems()
        ]);
    }

    public function updateItemQuantity(int $itemId, $quantity)
    {
        $index = $this->items->search(function(CartItem $item) use ($itemId) {
            return $item->id === $itemId;
        });

        if($index !== false) {
            if($quantity <= 0) {
                // Eliminar item si cantidad es 0 o menor
                $this->items->forget($index);
                $this->items->delete();
            } else {
                $this->items[$index]->setQuantity($quantity);
                $this->items[$index]->save();
            }

            $this->saveCartToLocalStorage();

            $this->dispatch('cart-updated', [
                'action' => 'updated',
                'cartCount' => $this->getTotalItems()
            ]);
        }
    }

    public function removeItem(int $itemId)
    {
        $item = $this->items->first(function(CartItem $item) use ($itemId) {
            return $item->id == $itemId;
        });

        if($item) {
            $itemName = $item->name;
            $this->items->forget($this->items->search($item));
            $item->delete();

            // sincornizar con localStorage
            $this->saveCartToLocalStorage();

            $this->dispatch('cart-updated', [
                'action' => 'removed',
                'product' => $itemName,
                'cartCount' => $this->getTotalItems()
            ]);
        }
    }

    public function clearCart()
    {
        $this->items->each->delete();
        $this->items = new Collection([]);

        $this->saveCartToLocalStorage();

        $this->dispatch('cart-updated', [
            'action' => 'cleared',
            'cartCount' => 0
        ]);
    }

    public function syncFromLocalStorage($cardData)
    {
        if(!is_array($cardData)) {
            return;
        }

        $this->items = CartItem::whereIn('id', array_column($cardData, 'id'))->get();
    }

    public function checkout()
    {
        if($this->items->isEmpty()) {
            $this->dispatch('cart-error', [
                'message' => 'No puedes procesar el pago con un carrito vacio'
            ]);

            return;
        }

        session(['cart_items' => $this->items->toArray()]);

        return redirect()->route('checkout');
    }

    public function increment($itemId)
    {
        $this->updateItemQuantity($itemId, $this->getItmeQuantity($itemId) + 1);
    }

    public function decrement($itemId)
    {
        $currentQty = $this->getItmeQuantity($itemId);

        if($currentQty > 1) {
            $this->updateItemQuantity($itemId, $currentQty - 1);
        } else {
            $this->removeItem($itemId);
        }
    }

    private function findProduct($productId, $type): Product | null
    {
        switch ($type){
            case Plate::PRODUCT_TYPE:
                return Plate::find($productId);
            default:
                return null;
        }
    }

    private function getItmeQuantity(int $itemId): int
    {
        $item = $this->items->first(function (CartItem $item) use ($itemId) {
            return $item->id == $itemId;
        });

        return $item ? $item->quantity : 0;
    }

    private function getTotalItems(): int
    {
        return $this->items->sum('quantity');
    }

    private function getSubtotal(): float
    {
        return $this->items->sum(function(CartItem $item) {
            return $item->getSubtotal();
        });
    }

    public function getTotal(): float
    {
        $subtotal = $this->getSubtotal();
        return $subtotal + $this->tax + $this->deliveryFee;
    }

    private function saveCartToLocalStorage()
    {
        $cartData = $this->items->toArray();
        $this->dispatch('save-cart',  ...['items' => $cartData]);
    }
}
