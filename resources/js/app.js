import './bootstrap'
import './carousel'
import CartHook from './cartHook'
import CartUI from './cartUI'

// document.addEventListener('DOMContentLoaded', function () {
//     CartUI.init()
// })

const useStorage = (key, valueDefault = null) => {
    const value = localStorage.getItem(key)

    const setValue = value => {
        localStorage.setItem(key, JSON.stringify(value))
    }

    if (localStorage.getItem(key) !== null) {
        valueDefault = JSON.parse(value)
    } else {
        setValue(valueDefault)
    }

    return [valueDefault, setValue]
}

//Logo Funcionality
document.addEventListener('DOMContentLoaded', function () {
    const loaderBg = document.getElementById('loader_bg')
    const loaderLogo = document.getElementById('loader_logo')
    const navLogo = document.getElementById('nav_logo')
    const navLogoContainer = document.getElementById('nav_logo_container')

    window.addEventListener('load', function () {
        if (loaderLogo) {
            setTimeout(function () {
                const transitionLogo = loaderLogo.cloneNode(true)
                document.body.appendChild(transitionLogo)

                const loaderReact = loaderLogo.getBoundingClientRect()
                const navReact = navLogoContainer.getBoundingClientRect()

                transitionLogo.classList.add('logo-transition')
                transitionLogo.style.top = loaderReact.top + 'px'
                transitionLogo.style.left = loaderReact.left + 'px'
                transitionLogo.style.width = loaderReact.width + 'px'
                transitionLogo.style.height = loaderReact.height + 'px'

                loaderLogo.style.opacity = '0'

                gsap.to(loaderBg, {
                    opacity: 0,
                    duration: 0.5,
                    ease: 'power2.inOut'
                })

                gsap.to(transitionLogo, {
                    top: navReact.top,
                    left: navReact.left,
                    width: navReact.width,
                    height: navReact.height,
                    duration: 0.8,
                    ease: 'back.out(1.7)',
                    onComplete: function () {
                        loaderBg.style.display = 'none'
                        navLogo.classList.add('visible')
                        setTimeout(function () {
                            transitionLogo.remove()
                        }, 100)
                    }
                })
            }, 500)
        }
    })
})

// Sidebar functionality
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar')
    const overlay = document.getElementById('overlay')
    const dismissButton = document.getElementById('dismiss')
    const sidebarCollapse = document.getElementById('sidebarCollapse')

    function openSidebar () {
        sidebar.classList.remove('-translate-x-full')
        overlay.classList.remove('hidden')
    }

    function closeSidebar () {
        sidebar.classList.add('-translate-x-full')
        overlay.classList.add('hidden')
    }

    sidebarCollapse.addEventListener('click', openSidebar)
    dismissButton.addEventListener('click', closeSidebar)
    overlay.addEventListener('click', closeSidebar)
})

//Script para manejar transisiones de vistas de menus
document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener(
        'click',
        async e => {
            if (e.target.matches('a.menu-item-link')) {
                e.preventDefault()

                const menuId = e.target.dataset.menuId

                if (!document.startViewTransition) {
                    window.location.href = link.href
                    return
                }

                try {
                    const transition = document.startViewTransition(
                        async () => {
                            const response = await fetch(e.target.href)
                            const text = await response.text()

                            const parser = new DOMParser()
                            const doc = parser.parseFromString(
                                text,
                                'text/html'
                            )
                            const content = doc.querySelector('main').innerHTML

                            document.title = doc.title
                            window.history.pushState({}, '', e.target.href)

                            document.querySelector('main').innerHTML = content

                            window.scrollTo({
                                top: 0
                            })
                        }
                    )

                    transition.ready.then(() => {
                        const targetElement = document.querySelector(
                            `[style*="view-transition-name: menu-image-${menuId}"]`
                        )

                        if (targetElement) {
                            targetElement.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            })
                        }
                    })
                } catch (error) {
                    console.error(
                        'Error durante la transicion de la vista:',
                        error
                    )
                    window.location.href = link.href
                }
            }
        },
        false
    )
    document.querySelectorAll('.menu-item-link').forEach(link => {})

    window.addEventListener('popstate', async e => {
        window.location.href = e.target.location.href
    })
})


//Scropt para la funcionalidad de anadir al carrito
// document.addEventListener('DOMContentLoaded', function () {
//     document.addEventListener('click', e => {
//         const target = e.target

//         const addToCartButton = target.closest('.add-to-cart')

//         if (addToCartButton) {
//             e.preventDefault()

//             const plateId = addToCartButton.dataset.plateId
//             const plateName = addToCartButton.dataset.plateName
//             const platePrice = addToCartButton.dataset.platePrice

//             console.log(plateId, plateName, platePrice)

//             showNotification(`¡${plateName} añadido al carrito!`)
//         }
//     })

//     function showNotification (message) {
//         const notification = document.createElement('div')
//         notification.className =
//             'fixed notification_card bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transform transition-al'
//         notification.textContent = message
//         document.body.appendChild(notification)

//         setTimeout(() => {
//             notification.classList.remove('translate-y-20', 'opacity-0')
//         }, 100)

//         setTimeout(() => {
//             notification.classList.add('translate-y-20', 'opacity-0')

//             setTimeout(() => {
//                 notification.remove()
//             }, 500)
//         }, 3000)
//     }
// })
