<div>
    <div class="py-2 border-bottom">
        <a href="catalog.html">Акции и 1 скидки</a>
    </div>
    @foreach($categories as $category)
        <div class="py-2 border-bottom">
            <a href="catalog.html">
                {{ $category->getName() }}
            </a>
        </div>
    @endforeach
</div>
