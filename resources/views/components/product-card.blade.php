        <x-card class="mb-4">
            <div class="mb-4 flex justify-between">
                <h2 class="text-lg font-medium">{{ $product->title }}</h2>
                <div class="text-slate-500">
                    {{ number_format($product->price, 2) }} USD
                </div>
            </div>
            <div class="mb-4 flex items-center justify-between text-sm text-slate-500">
                <div class="flex space-x-4">
                    <div>User Name</div>
                    <div>location</div>
                </div>
                <div class="flex space-x-1 text-xs">
                    <x-tag>Stock</x-tag>
                    <x-tag>images</x-tag>
                </div>

            </div>
            {{$slot}}
        </x-card>
