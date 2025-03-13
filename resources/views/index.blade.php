<x-app-layout>

    <!-- slider section -->
    <div class="bg-background py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-7xl mx-auto">
                <div id="main_slider" class="relative h-[600px]">
                    <div class="carousel-inner h-full">
                        <div class="carousel-item active h-full">
                            <div class="grid md:grid-cols-2 gap-8 items-center h-full">
                                <div class="space-y-6">
                                    <h3 class="text-4xl font-bold text-white">Discover Restaurants<br>That deliver near
                                        You</h3>
                                    <p class="text-gray-300">It is a long established fact that a reader will be
                                        distracted by the readable content of a page when looking at its layout.</p>
                                    <a href="#"
                                        class="uppercase inline-block px-8 py-3 border-2 border-green-600 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-colors">Order
                                        Now</a>
                                </div>
                                <div class="text-center">
                                    <img src="images/burger_slide.png" alt="Burger" class="max-w-full mx-auto" />
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item h-full">
                            <div class="grid md:grid-cols-2 gap-8 items-center h-full">
                                <div class="space-y-6">
                                    <h3 class="text-4xl font-bold text-white">Second Slide Restaurants<br>That deliver
                                        near You</h3>
                                    <p class="text-gray-300">It is a long established fact that a reader will be
                                        distracted by the readable content of a page when looking at its layout.</p>
                                    <a href="#"
                                        class="uppercase inline-block px-8 py-3 border-2 border-green-600 text-green-600 rounded-lg hover:bg-green-600 hover:text-white transition-colors">Order
                                        Now</a>
                                </div>
                                <div class="text-center">
                                    <img src="images/about-img.jpg" alt="Burger" class="max-w-full mx-auto" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-4">
                        <button title="Previous" class="p-2 h-10 w-10 bg-white rounded-full shadow-lg hover:bg-gray-100"
                            data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </button>
                        <button title="Next" class="p-2 h-10 w-10 bg-white rounded-full shadow-lg hover:bg-gray-100"
                            data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- section -->
    <section class="py-16 bg-background relative">
        <div class="absolute inset-0 -top-10 h-full">
            <img src="images/helper3.jpg" alt="Background" class="w-full h-[120%]" />
        </div>
        <div class="container mx-auto px-4">
            <div class="text-center relative mb-12">
                <h2 class="text-4xl font-bold text-white">Our Recipes</h2>
            </div>

            <div class="relative">
                <div class="owl-carousel grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <!-- Recipe Item 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="h-48 pt-4">
                            <img src="images/rs1.png" alt="Homemade" class="h-full mx-auto object-cover" />
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-motter font-semibold text-gray-800">Homemade</h3>
                            <h4 class="mt-2"><span class="text-blue-600">$</span>10</h4>
                        </div>
                    </div>

                    <!-- Recipe Item 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="h-48 pt-4">
                            <img src="images/rs2.png" alt="Noodles" class="h-full mx-auto object-cover" />
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-motter  text-gray-800">Noodles</h3>
                            <h4 class="mt-2"><span class="text-blue-600">$</span>20</h4>
                        </div>
                    </div>

                    <!-- Recipe Item 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="h-48 pt-4">
                            <img src="images/rs3.png" alt="Egg" class="h-full mx-auto object-cover" />
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-motter  text-gray-800">Egg</h3>
                            <h4 class="mt-2"><span class="text-blue-600">$</span>30</h4>
                        </div>
                    </div>

                    <!-- Recipe Item 4 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="h-48 pt-4">
                            <img src="images/rs4.png" alt="Sushi Dizzy" class="h-full mx-auto object-cover" />
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-motter text-gray-800">Sushi Dizzy</h3>
                            <h4 class="mt-2"><span class="text-blue-600">$</span>40</h4>
                        </div>
                    </div>

                    <!-- Recipe Item 5 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="h-48 pt-4">
                            <img src="images/rs5.png" alt="The Coffee Break" class="h-full mx-auto object-cover" />
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-motter  text-gray-800">The Coffee Break</h3>
                            <h4 class="mt-2"><span class="text-blue-600">$</span>50</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-background">
        <!-- about -->
        <div class="py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 relative">
                    <img src="images/title.png" alt="title" class="mx-auto mb-4" />
                    <h2 class="text-4xl font-bold text-white">About Our Food & Restaurant</h2>
                    <p class="mt-4 text-gray-300">It is a long established fact that a reader will be distracted by the
                        readable content of a page when looking at its layout. The point of using Lorem</p>
                </div>

                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6">
                        <h3 class="text-3xl font-bold text-white">Best Food</h3>
                        <p class="text-gray-300">Contrary to popular belief, Lorem Ipsum is not simply random text. It
                            has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years
                            old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up
                            one of the more obscureContrary to popular belief, Lorem Ipsum is not simply random text. It
                            has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years
                            old. Richard</p>
                        <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-700">
                            Read More
                            <i class="fa fa-long-arrow-right ml-2"></i>
                        </a>
                    </div>
                    <div class="relative">
                        <img src="images/about-img.jpg" alt="About" class="rounded-lg shadow-lg w-full" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-background">
        <div class="py-16 relative">
            <div class="absolute inset-0 -top-10 h-full">
                <img src="images/helper3.jpg" alt="Background" class="w-full h-[120%]">
            </div>
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 relative">
                    <img src="images/title.png" alt="title" class="mx-auto mb-4">
                    <h2 class="text-4xl font-bold text-white">Our Blog</h2>
                    <p class="mt-4 text-gray-300">when looking at its layout. The point of using Lorem</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 relative">
                    <!-- Blog Item 1 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="relative">
                            <img src="images/blog_img1.png" alt="Blog 1" class="w-full h-48 object-cover">
                            <span class="absolute top-4 left-4 bg-white px-3 py-1 rounded-full text-sm">02 FEB
                                2019</span>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Spicy Barger</h3>
                            <p class="text-gray-600">The standard chunk of Lorem Ipsum used since the 1500s is
                                reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus
                                Bonorum et Malorum" by Cicero are also reproduced in their exact original form,
                                accompanied by English versions from the</p>
                        </div>
                    </div>

                    <!-- Blog Item 2 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="relative">
                            <img src="images/blog_img2.png" alt="Blog 2" class="w-full h-48 object-cover">
                            <span class="absolute top-4 left-4 bg-white px-3 py-1 rounded-full text-sm">02 FEB
                                2019</span>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Egg &amp; Tosh</h3>
                            <p class="text-gray-600">The standard chunk of Lorem Ipsum used since the 1500s is
                                reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus
                                Bonorum et Malorum" by Cicero are also reproduced in their exact original form,
                                accompanied by English versions from the</p>
                        </div>
                    </div>

                    <!-- Blog Item 3 -->
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="relative">
                            <img src="images/blog_img3.png" alt="Blog 3" class="w-full h-48 object-cover">
                            <span class="absolute top-4 left-4 bg-white px-3 py-1 rounded-full text-sm">02 FEB
                                2019</span>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Pizza</h3>
                            <p class="text-gray-600">The standard chunk of Lorem Ipsum used since the 1500s is
                                reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus
                                Bonorum et Malorum" by Cicero are also reproduced in their exact original form,
                                accompanied by English versions from the</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-background">
        <!-- Our Client -->
        <div class="py-16 bg-background">
            <div class="container mx-auto px-4 relative">
                <div class="text-center mb-12">
                    <img src="images/title.png" alt="title" class="mx-auto mb-4" />
                    <h2 class="text-4xl font-bold text-white">Our Client</h2>
                </div>

                <div class="max-w-3xl mx-auto">
                    <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                        <img src="images/client.jpg" alt="Client" class="w-24 h-24 rounded-full mx-auto mb-6" />
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Roock Due</h3>
                        <p class="text-gray-600 mb-6">There are many variations of passages of Lorem Ipsum available,
                            but the majority have suffered alteration in some form, by injected humour, or randomised
                            words which don't look even slightly believable. If you are going to use a passage of Lorem
                            Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.
                        </p>
                        <img src="images/client_icon.png" alt="Quote" class="mx-auto" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
