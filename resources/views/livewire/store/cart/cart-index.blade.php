<div class="w-full">
    <div class="border-b border-gray-300 mb-10 pb-4 flex justify-between items-center">
        <h1 class="text-4xl font-bold text-white">
            <a href="{{route('store.home')}}" class="text-xl hover:underline hover:text-black transition duration-300 ease-in-out" wire:navigate>Home</a> <span class="text-xl">&raquo;</span> Carrinho
        </h1>
        <livewire:store.cart.cart-icon/>
    </div>

    <div class="w-full">
        @php $totalCart = 0; @endphp
        @foreach($cartItems as $item)
            <div class="w-full py-8 border-b border-gray-300 flex justify-around gap-5">
                <div class="w-1/3">
                    <img src="{{$item->photo ? asset('storage/' . $item->photo) : "https://picsum.photos/200" }}"
                         alt="Foto Produto: {{$item->name}}"
                         class="w-full h-52 rounded-t">
                </div>
                <div class="w-2/3 flex flex-col justify-center items-center">
                    <p class="text-left">
                    <h4 class="text-xl font-bold capitalize  text-white">{{$item->name}}</h4>
                    <h2 class="text-3xl font-bold  text-white">R$ {{number_format($item->price, 2, ',', '.')}}</h2>

                    <button class="text-white mt-10" wire:click="removeItem({{$item->id}})">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>

                    </button>
                    </p>
                </div>
            </div>
            @php $totalCart += $item->price; @endphp
        @endforeach
        <div class="w-full py-8 border-b border-gray-300 flex justify-around gap-5 text-white">
            <h2 class="w-1/3 text-2xl font-extrabold">Total:</h2>
            <strong class="w-2/3 text-2xl font-extrabold flex flex-col justify-center items-center">R$ {{ number_format($totalCart, 2, ',', '.')}}</strong>
        </div>

        <div class="w-full py-8 mt-10 flex justify-around gap-5 text-white">
            <button class="px-5 py-2 rounded text-white text-2xl font-bold bg-red-600" wire:click="clearCart">Cancelar</button>
            <a href="{{route('store.checkout')}}" wire:navigate class="px-5 py-2 rounded text-white text-2xl font-bold bg-green-600">Continuar</a>
        </div>
    </div>
</div>
