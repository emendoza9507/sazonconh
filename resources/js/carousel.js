

// Carousel functionality
class Carousel {
    constructor (element, options = {}) {
        this.options = {
            itemSelector: options.itemSelector ?? '.carousel-item'
        }
        this.element = element
        this.items = Array.from(
            element.querySelectorAll(this.options.itemSelector)
        )
        this.totalItems = this.items.length
        this.currentIndex = 0

        // Set up controls
        const prevButton = element.querySelector('[data-slide="prev"]')
        const nextButton = element.querySelector('[data-slide="next"]')

        if (prevButton) prevButton.addEventListener('click', () => this.prev())
        if (nextButton) nextButton.addEventListener('click', () => this.next())

        // Initial setup
        this.showItem(0)
    }

    showItem (index) {
        this.items.forEach(item => {
            item.classList.remove('active')
            item.style.display = 'none'
        })

        this.items[index].classList.add('active')
        this.items[index].style.display = 'block'
    }

    next () {
        this.currentIndex = (this.currentIndex + 1) % this.totalItems
        this.showItem(this.currentIndex)
    }

    prev () {
        this.currentIndex =
            (this.currentIndex - 1 + this.totalItems) % this.totalItems
        this.showItem(this.currentIndex)
    }
}

// Recipe carousel functionality
class RecipeCarousel {
    constructor (element, options = {}) {
        this.options = {
            itemSelector: options.itemSelector ?? '.carousel-item',
            classItemSelector: options.classItemSelector ?? 'carousel-item'
        }
        // Agregar las clases base a los elementos
        element.classList.add('recipe-carousel')

        // Crear un contenedor para facilitar la animación
        this.wrapper = document.createElement('div')
        this.wrapper.classList.add('recipe-carousel-container')

        // Mover los elementos al contenedor
        Array.from(element.children).forEach(child => {
            child.classList.add(this.options.classItemSelector, 'carousel-item')
            this.wrapper.appendChild(child)
        })

        element.appendChild(this.wrapper)

        this.container = element
        this.items = Array.from(this.wrapper.children)
        this.currentIndex = 0
        this.itemsPerView = {
            mobile: 1,
            tablet: 2,
            desktop: 4
        }

        // Configurar controles de navegación
        this.addControls()

        // Configurar visualización inicial
        this.setupDisplayItems()

        // Manejar cambios de tamaño de ventana
        window.addEventListener('resize', () => this.setupDisplayItems())

        // Agregar eventos de swipe
        this.addSwipeListeners()
    }

    addControls () {
        // Crear contenedor de controles
        const controls = document.createElement('div')
        controls.classList.add('carousel-controls')

        // Botón previo
        const prevBtn = document.createElement('div')
        prevBtn.classList.add('carousel-control')
        prevBtn.innerHTML = '<i class="fa fa-angle-left"></i>'
        prevBtn.addEventListener('click', () => this.prev())

        // Botón siguiente
        const nextBtn = document.createElement('div')
        nextBtn.classList.add('carousel-control')
        nextBtn.innerHTML = '<i class="fa fa-angle-right"></i>'
        nextBtn.addEventListener('click', () => this.next())

        // Agregar a los controles
        controls.appendChild(prevBtn)
        controls.appendChild(nextBtn)

        // Agregar controles al contenedor principal
        this.container.appendChild(controls)
    }

    setupDisplayItems () {
        const width = window.innerWidth
        let itemsToShow

        if (width < 600) {
            itemsToShow = this.itemsPerView.mobile
        } else if (width < 1000) {
            itemsToShow = this.itemsPerView.tablet
        } else {
            itemsToShow = this.itemsPerView.desktop
        }

        // Ocultar todos los items
        this.items.forEach(item => {
            item.classList.add('hidden')
            item.classList.remove('active')
        })

        // Mostrar los items correspondientes
        for (let i = 0; i < itemsToShow; i++) {
            const index = (this.currentIndex + i) % this.items.length
            this.items[index].classList.remove('hidden')
            this.items[index].classList.add('active')
        }
    }

    addSwipeListeners () {
        let startX = 0
        let endX = 0
        let isSwiping = false

        this.container.addEventListener(
            'touchstart',
            event => {
                if (event.target.classList.contains('btn-action')) return
                startX = event.touches[0].clientX
                isSwiping = true
            },
            {
                passive: true,
            }
        )

        this.container.addEventListener(
            'touchmove',
            event => {
                if (!isSwiping) return
                endX = event.touches[0].clientX

                // Prevenir scroll durante swipe horizontal significativo
                if (Math.abs(startX - endX) > 30) {
                    event.preventDefault()
                }
            },
            {
                passive: false
            }
        )

        this.container.addEventListener('touchend', () => {
            if (!isSwiping) return

            if (startX > endX + 50) {
                this.next()
            } else if (startX < endX - 50) {
                this.prev()
            }

            isSwiping = false
        })
    }

    next () {
        this.animateTransition('next')
        this.currentIndex = (this.currentIndex + 1) % this.items.length
        this.setupDisplayItems()
    }

    prev () {
        this.animateTransition('prev')
        this.currentIndex =
            (this.currentIndex - 1 + this.items.length) % this.items.length
        this.setupDisplayItems()
    }

    animateTransition (direction) {
        // Identificar elementos visibles actuales
        const visibleItems = this.items.filter(item =>
            item.classList.contains('active')
        )

        // Aplicar clase de salida
        visibleItems.forEach(item => {
            item.classList.add(`slide-${direction}-exit`)

            // Eliminar la clase después de la animación
            setTimeout(() => {
                item.classList.remove(`slide-${direction}-exit`)
                item.classList.remove(`slide-${direction}-exit-active`)
            }, 500)

            // Activar la animación
            setTimeout(() => {
                item.classList.add(`slide-${direction}-exit-active`)
            }, 50)
        })

        // Determinar qué elementos serán visibles después
        const width = window.innerWidth
        let itemsToShow

        if (width < 600) {
            itemsToShow = this.itemsPerView.mobile
        } else if (width < 1000) {
            itemsToShow = this.itemsPerView.tablet
        } else {
            itemsToShow = this.itemsPerView.desktop
        }

        const nextVisibleIndices = []
        for (let i = 0; i < itemsToShow; i++) {
            let index
            if (direction === 'next') {
                index = (this.currentIndex + 1 + i) % this.items.length
            } else {
                index =
                    (this.currentIndex - 1 + this.items.length + i) %
                    this.items.length
            }
            nextVisibleIndices.push(index)
        }

        // Aplicar clase de entrada a nuevos elementos
        nextVisibleIndices.forEach(index => {
            const item = this.items[index]
            item.classList.add(`slide-${direction}-enter`)
            item.classList.remove('hidden')

            // Eliminar la clase después de la animación
            setTimeout(() => {
                item.classList.remove(`slide-${direction}-enter`)
                item.classList.remove(`slide-${direction}-enter-active`)
            }, 500)

            // Activar la animación
            setTimeout(() => {
                item.classList.add(`slide-${direction}-enter-active`)
            }, 50)
        })
    }
}

// Initialize carousels when DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    // Initialize main slider
    const $mainSlider = document.getElementById('main_slider')

    if ($mainSlider !== null) {
        const mainSlider = new Carousel($mainSlider, {})
        let isMouseEnter = false;

        $mainSlider.addEventListener('mouseover', () => {
            isMouseEnter = true
        })

        $mainSlider.addEventListener('mouseout', () => isMouseEnter = false)
        setInterval(() => {
            if (!isMouseEnter) {
                mainSlider.next()
            }
        }, 3000)
    }

    // Initialize recipe carousel
    document.querySelectorAll('.owl-carousel').forEach(
        carousel =>
            new RecipeCarousel(carousel, {
                itemSelector:
                    carousel.getAttribute('data-item-selector') ??
                    'carousel-item',
                classItemSelector:
                    carousel.getAttribute('data-class-item-selector') ??
                    'carousel-item'
            })
    )

    // Loader functionality
    const loader = document.getElementById('loader_bg')
    if(loader)
    window.addEventListener('load', function () {
        setTimeout(() => {
            loader.style.display = 'none'
        }, 1000)
    })
})
