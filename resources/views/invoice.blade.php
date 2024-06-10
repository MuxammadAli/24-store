<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>#{{ $order->id }} - 24seven</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <style>
        * {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
        }

        @media only screen and (max-width: 768px) {
            .cols, .container {
                min-width: 800px;
            }
        }

        @media print {
            #printing {
                display: none;
            }

            .second-table {
                margin-top: 800px !important;
            }

        }
    </style>
</head>

<body>
<div class="container py-5">
    <div class="row">
        <div class="col-xl-8 col-lg-10 mx-auto cols">

            <h5 class="text-center font-weight-bold">АКТ ПРИЕМА-ПЕРЕДАЧИ</h5>
            <p class="text-center font-weight-bold">Товарно-материальных ценностей по заказу № {{ $order->id }}</p>

            <table class="table table-bordered">
                <tr>
                    <th>
                        №
                    </th>
                    <th>Название</th>
                    <th>Цена</th>
                    <th>Артикул</th>
                    <th>Кол-во</th>
                    <th>Сумма</th>
                </tr>

                @foreach($order->products as $product)
                    <tr>
                        <th>
                            {{ $loop->iteration }}
                        </th>
                        <th>{{ $product->product->getName() }}</th>
                        <th>{{ number_format($product->product->getRegionPrice()[1] ?? $product->product->getRegionPrice()[0], 0, '', ' ') }}</th>
                        <th>{{ $product->product->article_number }}</th>
                        <th>{{ $product->count }}</th>
                        <th>{{ number_format($product->product->getRegionPrice()[1] ?? $product->product->getRegionPrice()[0] * $product->count, 0, '', ' ') }}</th>
                    </tr>
                @endforeach
            </table>
            <div class="border p-3 border-dark">

                <b>Итого</b>: {{ number_format($order->price_product, 0, '', ' ') }} сум<br>
                <b>Адрес поставки</b>: {{ $order->getAddress() }} <br>
                <br>
                Принятый Покупателем товар обладает качеством и ассортиментом, соответствующим требованиям <br>
                Чека покупки. &#9634; Да &#9634; Нет <br>
                Товар поставлен в установленные сроки. &#9634; Да &#9634; Нет <br>
                Покупатель не имеет никаких претензий к принятому товару. ____________ &#9634; Имеется &#9634; Не имеется <br>
                _______________________ Подпись покупателя <br>
                Оплата за покупку по факту получение товара &#9634; Наличный расчет &#9634; Безналичный расчет <br>
                Способ оплаты:_________________________________________________________________________ <br>
                <b>Курьер</b>: <br>
                Получил денежных средств: ______________________________________________________________ <br>
                Подпись курьера ________________________________________________________________________ <br>
                ФИО и подпись лица, передающего товар (доставщик) _____________________________________<br>
                <br>
                ФИО и подпись лица, принимающего товар (покупатель)______________________________________ <br>
                Дата отгрузки: _______________________________Дата поставки:______________________________ <br>
                <br>
                При получении заказа просим вас внимательно осматривать товар. Претензии к внешнему виду товара и
                его комплектности вы можно предъявлять только во время осмотра товара при его получении от курьера.
                Претензии к внешнему виду и комплектации после отъезда курьера не принимаются. <br>
                Товар получил в надлежащем состоянии без каких либо дефектов _____________________________ <br>

            </div>
            <div class="border p-3 border-dark mt-5 second-table">
                <h6 class="font-weight-bold text-center">АКТ выполненных работ</h6> <br>
                Номер заказа {{ $order->id }} <br>
                М.П. <br>
                Отправитель: ООО 24Seven <br>

                Оператор: _____________ Тел.: +998 95 146 2424 Подпись: ____________________ <br>


                Точка забора:__________________________________________________________________________ <br>
                Адрес:__________________________________________________________________________________ <br>
                Контактный человек: ____________________________________________________________________ <br>
                Тел.: _____________________________________ Дата забора: _________ время__________________ <br>
                Подпись: _____________________________________________________________________________
                <p class="text-right">М.П. </p>

                <br>
                Получатель: {{ $order->user->name ?? $order->user->getFullName() }}<br>
                Адрес: {{ $order->getAddress() }}  <br>
                Тел.: +{{ $order->user->phone }} Время доставки: _____________________ Заказанный товар: <br>
                <table class="table table-borderless pb-0 mb-0">
                    <tr>
                        <th>№</th>
                        <th>Названия</th>
                        <th>Артикул</th>
                        <th>Кол-во</th>
                        <th>Сумма</th>
                    </tr>

                    @foreach($order->products as $product)
                        <tr>
                            <th>
                               {{ $loop->iteration }}
                            </th>
                            <th>{{ $product->product->getName() }}</th>
                            <th>{{ $product->product->article_number }}</th>
                            <th>{{ $product->count }}</th>
                            <th style="min-width: 110px">{{ number_format($product->price * $product->count, 0, ' ', ' ') }}</th>
                        </tr>
                    @endforeach
                </table>
                <b>Итого</b>: {{ number_format($order->price_product, 0, ' ', ' ') }} сум<br>
                Курьер: ____________________________<br>
                Дата доставки: _____________время__________ <br>
                Подпись: ____________________ <br>
                Примечание: <br>
            </div>
            <div class="d-flex justify-content-center align-items-center mt-5">
                <button id="printing" class="btn btn-dark"><i class="far fa-print"></i> Сохранить как PDF-Файл</button>
            </div>
        </div>
    </div>
</div>


<script>
    window.print();
    document.querySelector('#printing').addEventListener('click', function() {
        window.print();
    })
</script>
</body>

</html>
