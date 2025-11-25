<x-card class="mb-4">
    <div class="mb-4 flex justify-between">
        <div>
            <h2 class="text-lg font-medium">{{ $product->title }}</h2>
            <div class="text-sm text-slate-500">by {{ $product->user->name }}</div>
        </div>
        <div class="text-slate-500">
            {{ number_format($product->price, 2) }} USD
        </div>
    </div>

    <div class="mb-4 flex items-center justify-between text-sm text-slate-500">
        <div class="flex space-x-1 text-xs">
            <x-tag>Stock: {{ $product->stock }}</x-tag>
            <x-tag>Images: {{ $product->images->count() }}</x-tag>
        </div>
    </div>

    <p class="text-sm text-slate-700 mb-4">
        {!! Str::limit($product->description, 100) !!}
    </p>

    {{ $slot }}

    {{-- Comments preview for product --}}
    @if($product->comments->count())
        <div class="mt-4 border-t pt-2">
            <h3 class="text-sm font-semibold mb-2">Comments ({{ $product->comments->count() }})</h3>
            @foreach($product->comments as $comment)
                <div class="mb-2 text-sm">
                    <span class="font-semibold">{{ $comment->user->name }}:</span>
                    <span>{{ $comment->comment }}</span>
                </div>
            @endforeach
        </div>
    @endif
</x-card>
