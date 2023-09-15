<div>
    <x-slot name="header">Produtos</x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full mb-10 flex justify-end">
                <a href="{{route('admin.product.create')}}"
                   class="px-4 py-2 text-white font-bold bg-green-800 border border-green-900
                                rounded hover:bg-green-400 transition ease-in-out duration-300" wire:navigate
                >
                    Criar Produto
                </a>
            </div>

            @if(session()->has('success'))
                <div class="px-4 py-2 mb-10 rounded bg-green-500 border border-green-900 text-white font-bold">
                    {{session('success')}}
                </div>
            @endif

            <livewire:admin.products.products />

        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
          window.addEventListener('livewire:init', event => {
              window.addEventListener('sweet:open', event => {
                  Swal.fire({
                      title: 'Atenção!!',
                      text: 'Você deseja remover o produto?',
                      icon: 'error',
                      showCloseButton: true,
                      showCancelButton: true,
                      confirmButtonText: 'Remover',
                      cancelButtonText: `Cancelar`,
                  }).then(result => {
                      if(result.isConfirmed) {
                          Livewire.dispatch('productDelete:' + event.detail.id, {product: event.detail.id})
                          return;
                      }
                  })
              })
          });
        </script>
    @endpush
</div>
