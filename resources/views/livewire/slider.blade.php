<div>
    <div class="mb-10 overflow-y-scroll flex flex-row gap-x-2 shadow-inner">
        @foreach ($categories as $category)
            <livewire:category.box :category="$category" />
        @endforeach
    </div>
</div>
