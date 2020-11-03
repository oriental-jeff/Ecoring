<!doctype html>
<html>

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>INVOICE 3-2-1</title>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet"> --}}
    <style>
        body {
            padding: 60px 40px;
            margin: 0;
            font-family: 'Kanit', sans-serif;
            font-weight: 100;
        }

        .box-paper {
            display: block;
            margin: auto;
            max-width: 1000px;
        }

        .box-paper img.img-logo {
            margin: auto;
            display: block;
            width: 150px;
        }

        .box-paper h1.head {
            border-top: 2px solid #a7a7a7;
            border-bottom: 2px solid #a7a7a7;
            text-align: center;
            text-transform: uppercase;
        }

        .box-paper .box-top {
            display: inline-block;
            width: 100%;
        }

        .box-paper .box-top .box-left {
            float: left;
        }

        .box-paper .box-top .box-left p {}

        .box-paper .box-top .box-right {
            float: right;
        }

        .box-paper .box-top .box-right table {}

        .box-paper .box-top .box-right tr {}

        .box-paper .box-top .box-right td {
            padding: 0px 8px;
        }

        .box-paper .box-top .box-right td:first-child {
            color: #868686;
            text-align: right;
        }

        .box-paper .box-top a {
            color: #868686;
        }

        table.box-list {
            width: 100%;
            margin-top: 45px;
            border-collapse: collapse;
        }

        table.box-list thead {}

        table.box-list thead tr {
            border-bottom: 2px solid #000;
        }

        table.box-list thead th {
            padding: 10px 15px;
            text-align: left;
            color: #7b7b7b;
            border: 0;
            border-bottom: 2px solid #c5d2d4;
        }

        table.box-list tbody {}

        table.box-list tbody tr {}

        table.box-list tbody td {
            padding: 20px 15px;
        }

        table.box-list tbody tr:nth-child(odd) td {
            background-color: #f5f5f5;
        }

        table.box-list tbody td:first-child {
            vertical-align: top;
        }

        table.box-list tbody .border-top td {
            border-top: 2px solid #a5a5a5;
        }

        .align-center {
            text-align: center !important;
        }

        .align-right {
            text-align: right !important;
        }
    </style>
</head>

<body>
    <div class="box-paper">
        <img src="http://ecoringcommerce.am2bmarketing.co.th/storage/1/logo.png" alt="logo" class="img-logo">
        <h1 class="head">ใบเสร็จรับเงิน / R E C E I P T</h1>
        <div class="box-top">
            <div class="box-left">
                <p>
                    {{ $web_info[0]->{get_lang('company_name')} }}<br>
                    {!! nl2br($web_info[0]->{get_lang('company_address')}) !!}<br>
                    {{ $web_info[0]->company_tel }}<br>
                    <a href="mailto:{{ $web_info[0]->company_email }}">{{ $web_info[0]->company_email }}</a>
                </p>
            </div>

            <div class="box-right">
                <table>
                    <tr>
                        <td>หมายเลขใบเสร็จรับเงิน / NUMBER</td>
                        <td>#{{ $order[0]->rcpt_number }}</td>
                    </tr>
                    <tr>
                        <td>วันที่ / DATE</td>
                        <td>{{ mysqlFormatToThaiFormat($order[0]->created_at) }}</td>
                    </tr>
                    <tr>
                        <td>ชื่อ / CLIENT</td>
                        <td>{{ $order[0]->fullname }}</td>
                    </tr>
                    <tr>
                        <td>ที่อยู่ / ADDRESS</td>
                        <td>{{ $order[0]->address.', '.$order[0]->sub_districts->{get_lang('name')} }}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>{{ $order[0]->districts->{get_lang('name')}.', '.$order[0]->provinces->{get_lang('name')}.', '.$order[0]->postcode }}
                        </td>
                    </tr>
                    <tr>
                        <td>อีเมล์ / EMAIL</td>
                        <td><a href="mailto:{{ $order[0]->user->email }}">{{ $order[0]->user->email }}</a></td>
                    </tr>
                    <tr>
                        <td>หมายเลขคำสั่งซื้อ / ORDER NUMBER</td>
                        <td>#{{ $order[0]->code }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <table class="box-list">
            <thead>
                <tr>
                    {{-- <th>SERVICE</th> --}}
                    <th style="width: 450px;">ชื่อสินค้า / Name</th>
                    <th class="align-center">ราคา / PRICE</th>
                    <th class="align-center">จำนวน / QTY</th>
                    <th class="align-right">ราคา / TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order[0]->cart as $cart)
                <tr>
                    {{-- <td class="service">Design</td> --}}
                    <td>{!! $cart->product->{get_lang('description')} !!}</td>
                    <td class="align-center">฿{{ number_format($cart->amount, 2) }}</td>
                    <td class="align-center">{{ $cart->quantity }}</td>
                    <td class="align-right">฿{{ number_format($cart->amount, 2) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td class="align-right" colspan="3">ยอดรวม / SUBTOTAL</td>
                    <td class="align-right">฿ {{ number_format($order[0]->total_amount, 2) }}</td>
                </tr>

                <tr>
                    <td class="align-right" colspan="3">ภาษี / VAT 7%</td>
                    <td class="align-right">฿ {{ number_format($order[0]->vat, 2) }}</td>
                </tr>

                <tr class="border-top">
                    <td class="align-right" colspan="3">ยอดรวมสุทธิ / GRAND TOTAL</td>
                    <td class="align-right">฿ {{ number_format($order[0]->total_amount + $order[0]->vat, 2) }}</td>
                </tr>
            </tbody>
            {{-- <tbody>
                @foreach ($order[0]->cart as $cart)
                <tr>
                    <td>Development</td>
                    <td>{!! $cart->product->{get_lang('description')} !!}</td>
                    <td class="align-center">{{ number_format($cart->amount, 2) }}</td>
            <td class="align-center">{{ $cart->quantity }}</td>
            <td class="align-right">{{ number_format($cart->amount, 2) }}</td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td class="align-right" colspan="4">SUBTOTAL</td>
                    <td class="align-right">$5,200.00</td>
                </tr>
                <tr>
                    <td class="align-right" colspan="4">TAX 25%</td>
                    <td class="align-right">$1,400.00</td>
                </tr>
                <tr class="border-top">
                    <td class="align-right" colspan="4">GRAND TOTAL</td>
                    <td class="align-right">$6,500.00</td>
                </tr>
            </tfoot> --}}
        </table>

        <br>
        <h3 style="margin: 0px;">หมายเหตุ / NOTICE</h3>
        <p style="margin: 0px;color: #7b7b7b;">
            A finance charge of 1.5% will be made on unpaid balances after 30 days.
        </p>

        <p style="margin: 0px;color: #7b7b7b;">
            อีเมลฉบับนี้เป็นการแจ้งข้อมูลจากระบบโดยอัตโนมัติ กรุณาอย่าตอบกลับ
        </p>
    </div>
</body>

</html>
