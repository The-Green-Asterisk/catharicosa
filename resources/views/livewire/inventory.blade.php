<div>
    <style>
        .inv p {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }
    </style>
    @foreach ($inv as $item)
        <div class="mb-4 inv">
            <p class="font-bold">{{ $item->definition->name }}</p>
            {!! $item->definition->description !!}
        </div>
    @endforeach
</div>
