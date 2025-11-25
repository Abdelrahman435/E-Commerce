<x-layout>
    <x-breadcrumbs class="mb-4"
        :links="['Products' => route('products.index'), $product->title => '#']"/>

    <x-product-card :product="$product">
        <p class="text-sm text-slate-500 mb-4">
            {!! nl2br(e($product->description)) !!}
        </p>

            {{-- Form to add new comment --}}
            @auth
            <form action="{{ route('comments.store', $product) }}" method="POST" class="mt-3">
                @csrf
                <x-text-input name="comment" placeholder="Add a comment..." />
                <x-button class="mt-2">Post Comment</x-button>
            </form>
            @endauth
        </div>
    </x-product-card>
</x-layout>
