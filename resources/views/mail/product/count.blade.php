Количество товара <a href="{{ route('product.show', [$product->id, $product->getSlug()]) }}"><b>{{ $product->getName() }}</b></a> стало меньшее 10
<br>Количество: <b>{{ $product->count }}</b>
