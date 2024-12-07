<x-app-layout>
    <x-slot name="title">
        My Order
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Order') }} ({{$count}})
    </x-slot>

    <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
        <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
            @foreach($cart as $order)
            <div class="rounded overflow-hidden shadow-lg">
                    <a href="#"></a>
                    <div class="relative">
                            @if ($order->product->image != "")
                            <img class="w-full" src="{{asset('uploads/product/'.$order->product->image)}}" alt="">
                                                
                             @endif
                            <div
                                class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25">
                            </div>

                            <div
                                class="absolute bottom-0 left-0 bg-black px-4 py-2 text-white text-sm hover:bg-white hover:text-black transition duration-500 ease-in-out">
                                Rp.{{$order->product->price}}
                            </div>

                        <a href="" class="remove-from-cart" data-id="{{ $order->id }}">
                            <div
                                class="text-sm absolute top-0 right-0 bg-black px-4 text-white rounded-full h-10 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-black transition duration-500 ease-in-out">
                                <span class="font-bold">Delete</span>
                            </div>
                        </a>
                    </div>
                    <div class="px-6 py-4">
        
                        <p class="text-black font-bold text-2xl">{{$order->product->name}}</p> 
                        <p class="text-gray-500">
                            {{$order->product->description}}
                        </p>
                    </div>
                    <div class="px-6 py-4 flex flex-row items-center">
                        <span href="#" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                            <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512"
                                style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256
                    c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128
                    c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z"></path>
                                    </g>
                                </g>
                            </svg>
                            <span class="ml-1 pr-5">{{\Carbon\Carbon::parse($order->created_at)->format('d M, Y')}}</span>
                            <span class="pt-0.5"><i class="fa-solid fa-cube" style="color: #000000;"></i></span>
                            <span class="ml-1"> total product {{ $order->quantity }}</span>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil semua elemen dengan class "remove-from-cart"
        const removeCartLinks = document.querySelectorAll('.remove-from-cart');

        removeCartLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault(); // Cegah refresh halaman

                const cartId = this.dataset.id; // Ambil ID keranjang

                // Kirim permintaan AJAX atau Fetch ke server
                fetch(`/remove_cart/${cartId}`)
                    .then(response => {
                        if (response.ok) {
                            // Tampilkan notifikasi SweetAlert
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Produk berhasil dihapus dari keranjang.',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Refresh halaman setelah notifikasi selesai
                                location.reload();
                            });
                        } else {
                            // Tampilkan notifikasi error
                            Swal.fire({
                                title: 'Error!',
                                text: 'Gagal menghapus produk dari keranjang.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan. Silakan coba lagi.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            });
        });
    });
</script>


