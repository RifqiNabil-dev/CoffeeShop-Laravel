<x-app-layout>
    <x-slot name="title">
        Dashboard Admin
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>


    <div class="max-w-screen-xl mx-auto p-2 sm:p-10 md:p-16">
        <div class="border-b mb-5 flex justify-between text-sm">
            <div class="text-black flex items-center pb-2 pr-2 border-b-2 border-black uppercase">
                <i class="fa-solid fa-list h-3 mr-3" style="color: #ffffff;"></i>
                <a href="#" class="font-semibold inline-block">Product List</a>
            </div>
            <a href="#">See All</a>
        </div>
        <div class="p-6 text-gray-900">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
                            @if ($products->isNotEmpty())
                            @foreach ($products as $product )
                                    <!-- CARD 1 -->
                            <div class="rounded overflow-hidden shadow-lg flex flex-col">
                                <a href="#"></a>
                                <div class="relative"><a href="#">
                                        @if ($product->image != "")
                                                <img width="380px" src="{{asset('uploads/product/'.$product->image)}}" alt="">
                                                                    
                                        @endif
                                        <div
                                            class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                                        </div>
                                    </a>
                                    <a href="#!">
                                        <div
                                            class="text-xs absolute top-0 right-0 bg-black px-4 py-2 text-white mt-3 mr-3 hover:bg-white hover:text-black transition duration-500 ease-in-out">
                                            Stock : {{$product-> sku}}
                                        </div>
                                    </a>
                                </div>
                                <div class="px-6 py-4 mb-auto">
                                    <a href="#"
                                        class="text-black font-bold text-lg inline-block hover:text-black transition duration-500 ease-in-out inline-block mb-2">
                                        {{$product-> name}}</a>
                                    <p class="text-gray-500 text-sm">
                                    {{$product-> description}}
                                    </p>
                                </div>
                                <div class="px-6 py-3 flex flex-row items-center justify-between bg-gray-100">
                                    <span href="#" class="py-1 text-xs font-regular text-gray-900 mr-1 flex flex-row items-center">
                                        <svg height="13px" width="13px" version="1.1" id="Layer_1"
                                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                            y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                            xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path
                                                        d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256 c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128 c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="ml-1">{{\Carbon\Carbon::parse($product->created_at)->format('d M, Y')}}</span>
                                    </span>
                        
                                    <span href="#" class="py-1 text-xs font-regular text-gray-900 mr-1 flex flex-row items-center">
                                    <i class="fa-solid fa-money-bill"></i>
                                        <span class="ml-1">Rp.{{$product-> price}}</span>
                                    </span>
                                </div>
                            </div>
                            @endforeach
                                                                
                            @endif
            </div>
        </div>
    </div>
</x-app-layout>