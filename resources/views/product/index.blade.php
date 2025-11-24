<x-layout>
    <x-breadcrumbs class="mb-4"
    :links="['Products' => route('products.index')]"/>

    <x-card class="mb-4 text-sm">
        <form action="{{route('products.index')}}" method="GET">
        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <div class="mb-1 font-semibold">Search</div>
                <x-text-input :name="'search'" value="{{ request('search') }}" placeholder="Search products"></x-text-input>
            </div>
            <div>
                <div class="mb-1 font-semibold">Price</div>
                <div class="fle space-x-2">
                    <x-text-input :name="'min_price'" value="{{ request('min_price') }}" placeholder="From"></x-text-input>
                    <x-text-input :name="'max_price'" value="{{ request('max_price') }}" placeholder="To"></x-text-input>
                </div>
            <div>
                <!-- <div class="mb-1 font-semibold">Salary</div>
                <x-text-input :name="'search'" value="" placeholder="Search products"></x-text-input></div> -->
            </div>
            <div>4</div>
        </div>
        <button class="w-full">Filter</button>
        </form>
    </x-card>

    @foreach ($products as $product)
      <x-product-card class="mb-4" :product="$product">
        <div>
            <x-link-button :href="route('products.show', $product)">
                View Details
            </x-link-button>
        </div>
      </x-product-card>
    @endforeach
</x-layout>
