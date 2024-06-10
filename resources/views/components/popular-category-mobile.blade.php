<ul class="nav">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('stocks') }}">Акции и скидки</a>
    </li>

    @foreach($categories as $category)
        <li class="nav-item">
            <a class="nav-link" href="{{ $category->link }}">
                {{ $category->getName() }}
            </a>
        </li>
    @endforeach
</ul>
