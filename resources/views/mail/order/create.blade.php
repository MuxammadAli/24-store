<h1>Новый заказ</h1>
<table>
    <thead>
    <tr>
        <th style="text-align: left">ID:</th>
        <td style="padding-left: 15px">{{ $order->id }}</td>
    </tr>
    <tr>
        <th style="text-align: left">Пользователь:</th>
        <td style="padding-left: 15px"><a href="tel:{{ $order->user->getPhone() }}">+{{ $order->user->getPhone() }}</a></td>
    </tr>
    <tr>
        <th style="text-align: left">Стоимость:</th>
        <td style="padding-left: 15px">{{ $order->price_product }}</td>
    </tr>
    <tr>
        <th style="text-align: left">Регион:</th>
        <td style="padding-left: 15px">{{ $order->address->getRegion() }}</td>
    </tr>
    </thead>
</table>
<br>
<a target="_blank" href="{{ route('dashboard.orders.view', $order->id) }}">Посмотреть на сайте</a>
