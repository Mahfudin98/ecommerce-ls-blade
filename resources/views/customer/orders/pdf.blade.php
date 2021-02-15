<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Invoice #{{ $order->invoice }}</title>
        <style>
            @font-face {
                font-family: 'Source Sans Pro', sans-serif;
                src: url(https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap);
            }

            .clearfix:after {
                content: "";
                display: table;
                clear: both;
            }

            a {
                color: #ffb19b;
                text-decoration: none;
            }

            body {
                position: relative;
                margin: 0 auto;
                color: #555555;
                background: #FFFFFF;
                font-family: Arial, sans-serif;
                font-size: 14px;
                font-family: 'Source Sans Pro', sans-serif;
            }

            header {
                padding: 10px 0;
                margin-bottom: 20px;
                border-bottom: 1px solid #AAAAAA;
            }

            #logo {
                float: left;
                margin-top: 8px;
            }

            #logo img {
                height: 70px;
            }

            #company {
                width: 100%;
                float: right;
                text-align: right;
            }


            #details {
                margin-bottom: 50px;
            }

            #client {
                padding-left: 6px;
                border-left: 6px solid #ffb19b;
                float: left;
            }

            #client .to {
                color: #777777;
            }

            h2.name {
                font-size: 1.4em;
                font-weight: normal;
                margin: 0;
                color: #f27272;
            }

            #invoice {
                width: 100%;
                float: right;
                text-align: right;
            }

            #invoice h1 {
                color: #ffb19b;
                font-size: 2.4em;
                line-height: 1em;
                font-weight: normal;
                margin: 0  0 10px 0;
            }

            #invoice .date {
                font-size: 1.1em;
                color: #777777;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                border-spacing: 0;
                margin-bottom: 20px;
            }

            table th,
            table td {
                padding: 20px;
                background: #EEEEEE;
                text-align: center;
                border-bottom: 1px solid #FFFFFF;
            }

            table th {
                white-space: nowrap;
                font-weight: normal;
            }

            table td {
                text-align: right;
            }

            table td h3{
                color: #f27272;
                font-size: 1.2em;
                font-weight: normal;
                margin: 0 0 0.2em 0;
            }

            table .no {
                color: #FFFFFF;
                font-size: 1.6em;
                background: #f27272;
            }

            table .desc {
                text-align: left;
            }

            table .unit {
                background: #DDDDDD;
            }

            table .qty {
            }

            table .total {
                background: #f27272;
                color: #FFFFFF;
            }

            table td.unit,
            table td.qty,
            table td.total {
                font-size: 1.2em;
            }

            table tbody tr:last-child td {
                border: none;
            }

            table tfoot td {
                padding: 10px 20px;
                background: #FFFFFF;
                border-bottom: none;
                font-size: 1.2em;
                white-space: nowrap;
                border-top: 1px solid #AAAAAA;
            }

            table tfoot tr:first-child td {
                border-top: none;
            }

            table tfoot tr:last-child td {
                color: #f27272;
                font-size: 1.4em;
                border-top: 1px solid #f27272;
            }

            table tfoot tr td:first-child {
                border: none;
            }

            #thanks{
                font-size: 2em;
                margin-bottom: 50px;
            }

            #notices{
                padding-left: 6px;
                border-left: 6px solid #ffb19b;
            }

            #notices .notice {
                font-size: 1.2em;
            }

            footer {
                color: #777777;
                width: 100%;
                height: 30px;
                position: absolute;
                bottom: 0;
                border-top: 1px solid #AAAAAA;
                padding: 8px 0;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <header class="clearfix">
        <div id="logo">
            <img src="https://lh3.googleusercontent.com/d/1PVOFE-UJYo_lp2_YOIlqpVyba5XD9n94?authuser=0">
        </div>
        <div id="company">
            <h2 class="name">LS Skincare</h2>
            <div>Blok MekarMulya, Rt/Rw 01/01</div>
            <div>Ds Tenjolayar, Kec Cigasong</div>
            <div>Kab Majalengka, Prov Jawa barat</div>
            <div>(0233) 8285547</div>
            <div><a href="mailto:lsastariasukses@gmail.com">lsastariasukses@gmail.com</a></div>
        </div>
        </div>
        </header>
        <main>
        <div id="details" class="clearfix">
            <div id="client">
            <div class="to">PENERIMA:</div>
            <h2 class="name">{{ $order->customer_name }}</h2>
            <div class="address">{{ $order->customer_address }}</div>
            <div class="address">
                {{ $order->district->name }},
                {{ $order->district->city->name }} {{ $order->postal_code }},
                {{ $order->district->city->province->name }}
            </div>
            <div class="email"><a href="#">{{ $order->customer_phone }}</a></div>
            </div>
            <div id="invoice">
            <h1>{{ $order->invoice }}</h1>
            <div class="date">Tanggal: {{date('M d, Y', strtotime($order->created_at))}}</div>
            </div>
        </div>
        <table cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th class="no">#</th>
                <th class="desc">NAMA PRODUK</th>
                <th class="unit">HARGA</th>
                <th class="qty">QUANTITY</th>
                <th class="total">TOTAL</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($order->details as $index => $row)
                <tr>
                    <td class="no">{{ $index +1 }}</td>
                    <td class="desc">{{ $row->product->name }}</td>
                    <td class="unit">Rp.{{ number_format($row->price) }}</td>
                    <td class="qty">{{ $row->qty }}</td>
                    <td class="total">Rp.{{ number_format($row->price * $row->qty) }}</td>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">SUBTOTAL</td>
                    <td>Rp {{ number_format($order->subtotal) }}</td>
                </tr>
                @if ($order->payment)
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">Pembayaran</td>
                    <td>Rp -{{ number_format($order->payment->amount) }}</td>
                </tr>
                @endif
            </tfoot>
        </table>
        @if ($order->payment)
        <div id="thanks">Terima kasih sudah berbelanja!</div>
        <div id="notices">
            <div><strong>PENGIRIM:</strong> {{ $order->payment->name }}</div>
            <div class="notice">Transfer ke: {{ $order->payment->transfer_to }}</div>
            <div class="notice">Tanggal: {{ date('M d, Y', strtotime($order->payment->transfer_date))  }}</div>
        </div>
        @else
            <div id="thanks">Silahkan Lakukan Pembayaran!</div>
            <div id="notices">
                <div><strong>Catatan:</strong></div>
                <div class="notice">Dimohon untuk segera melaukan pembayaran, agar barang cepat dikirim. Trimakasih!</div>
            </div>
        @endif
        </main>
        <footer>
            Faktur dibuat di komputer dan valid tanpa tanda tangan dan segel.
        </footer>
    </body>
</html>
