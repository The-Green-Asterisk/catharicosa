<div class="flex flex-row gap-2">
    @foreach ($categories as $category)
    <livewire:category.box :category="$category" :catName="$catName" />
    @endforeach
</div>
