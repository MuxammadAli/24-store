<table>
    <thead>
    <tr>
        <th scope="col" width="5">ID</th>
        <th scope="col" width="17">@lang('admin.orders.user')</th>
        <th scope="col" width="19">Дата заказа</th>
        <th scope="col" width="16">Стоимость заказа</th>
        <th scope="col" width="13">Статус</th>
        <th scope="col">Район</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>
                {{ $order->id }}
            </td>
            <td>
                +{{ sprintf("%s (%s) %s-%s-%s",
              substr($order->user->getPhone(), 0, 3),
              substr($order->user->getPhone(), 3, 2),
              substr($order->user->getPhone(), 5, 3),
              substr($order->user->getPhone(), 8, 2),
              substr($order->user->getPhone(), 10, 2)) }}
            </td>

            <td>
                {{ date('H:i - d.m.Y', strtotime($order->created_at)) }}
            </td>

            <td>
                {{ number_format($order->price_product, 0, ' ', ' ') }}
            </td>

            <td>
                {{ $order->getStatus() }}
            </td>
            <td>
                {{ $order->user->region->name['ru'] ?? '' }}
            </td>

        </tr>
    @endforeach
    </tbody>
</table>
