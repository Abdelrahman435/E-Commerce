<x-layout>
    <x-breadcrumbs class="mb-4"
    :links="['Products' => route('products.index') , $product->title => '#']"/>
    <x-product-card :$product>
            <p class="text-sm text-slate-500 mb-4">
                {!! nl2br(e($product->description)) !!}
            </p>
    </x-product-card>
</x-layout>
