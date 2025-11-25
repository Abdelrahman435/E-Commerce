<x-layout>
    <x-breadcrumbs class="mb-4"
        :links="['Products' => route('products.index')]"/>

    <x-card class="mb-4 text-sm" x-data="">
        <form x-ref="filters" id="filtering-form" action="{{route('products.index')}}" method="GET">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                    <div class="mb-1 font-semibold">Search</div>
                    <x-text-input :name="'search'" value="{{ request('search') }}" placeholder="Search products" form-ref="filters"></x-text-input>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Price</div>
                    <div class="flex space-x-2">
                        <x-text-input :name="'min_price'" value="{{ request('min_price') }}" placeholder="From" form-ref="filters"></x-text-input>
                        <x-text-input :name="'max_price'" value="{{ request('max_price') }}" placeholder="To" form-ref="filters"></x-text-input>
                    </div>
                </div>
            </div>
            <x-button class="w-full">Filter</x-button>
        </form>
    </x-card>

    @foreach ($products as $product)
        <x-product-card :product="$product">
            <x-link-button :href="route('products.show', $product)">
                View Details
            </x-link-button>
        </x-product-card>
    @endforeach
</x-layout>
