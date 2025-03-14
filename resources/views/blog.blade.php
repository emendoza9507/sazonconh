<x-app-layout>
    <section class="bg-background">
        <div class="py-16 relative">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12 relative">
                    <img src="images/title.png" alt="title" class="mx-auto mb-4">
                    <h2 class="text-4xl font-bold text-white">Our Blog</h2>
                    <p class="mt-4 text-gray-300">when looking at its layout. The point of using Lorem</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 relative">
                    @foreach ($lastPosts as $post)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="relative">
                            <img src="{{url($post->cover_image)}}" alt="{{$post->title}}" class="w-full h-48 object-cover">
                            <span class="absolute top-4 left-4 bg-white px-3 py-1 rounded-full text-sm">02 FEB
                                2019</span>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">{{$post->title}}</h3>
                            <p class="text-gray-600">{!! Str::limit(strip_tags($post->content), 150) !!}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    <div class="flex justify-center">
                        @if ($lastPosts->onFirstPage())
                            <span class="rounded-md px-4 py-2 mx-1 bg-gray-300 text-gray-500 cursor-not-allowed">Atrás</span>
                        @else
                            <a href="{{ $lastPosts->previousPageUrl() }}" class="rounded-md px-4 py-2 mx-1 bg-green-600 text-white hover:bg-green-700">Atrás</a>
                        @endif

                        @if ($lastPosts->hasMorePages())
                            <a href="{{ $lastPosts->nextPageUrl() }}" class="rounded-md px-4 py-2 mx-1 bg-green-600 text-white hover:bg-green-700">Adelante</a>
                        @else
                            <span class="rounded-md px-4 py-2 mx-1 bg-gray-300 text-gray-500 cursor-not-allowed">Adelante</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>