<div class="w-full mt-20">

    <div class="border-b border-gray-300 mb-10 pb-4 flex justify-between items-center">
        <h1 class="text-4xl font-bold text-white">Produtos</h1>
        <livewire:store.cart.cart-icon/>
    </div>

    <div class="max-w-7xl grid grid-cols-3 gap-14">
        @foreach($products as $product)
            <div class="w-96 bg-white border border-gray-300 rounded mb-10 shadow">
                <img src="{{$product->photo ? asset('storage/' . $product->photo) : "https://picsum.photos/200" }}"
                     alt="Foto Produto: {{$product->name}}"
                     class="w-full h-52 rounded-t">

                <div class="p-4">
                    <h4 class="text-xl font-bold capitalize">{{$product->name}}</h4>

                    <h2 class="text-3xl mt-10 font-bold text-red-800">R$ {{number_format($product->price, 2, ',', '.')}}</h2>

                    <button wire:click="addCart({{$product->id}})"
                            class="px-8 py-4 mt-5 bg-gradient-to-b from-purple-500 to-purple-800
                                   font-bold text-white transition-all duration-300 ease-in-out rounded
                                   hover:to-purple-800 hover:from-purple-900">
                        Comprar
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
