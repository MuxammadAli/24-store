<table>
    <thead>
    <tr>
        <th scope="col" width="5">ID</th>
        <th scope="col">Артикул</th>
        <th scope="col" width="40">Название</th>
        <th scope="col" width="40">Категория</th>
        <th scope="col" width="20">Суб категория</th>
        <th scope="col" width="25">Под категория</th>
        <th scope="col" width="20">Количество доступное</th>
        <th scope="col" width="13">Цена</th>
        <th scope="col" width="16">Цена со скидкой</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>
                {{ $product->id }}
            </td>
            <td>
                {{ $product->article_number }}
            </td>
            <td>
                {{ $product->getName() }}
            </td>
            <td>
                {{ $product->mainCategory() ? $product->mainCategory()->name['ru'] : '' }}
            </td>
            <td>
                {{ $product->category() ? $product->category()->name['ru'] : '' }}
            </td>
            <td>
                {{ $product->subCategory() ? $product->subCategory()->name['ru'] : '' }}
            </td>
            <td>
                {{ $product->count }}
            </td>
            <td>
                {{ number_format($product->price, 0, ' ', ' ') }} сум
            </td>
            <td>
                {{ number_format($product->discount_price, 0, ' ', ' ') }} сум
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
