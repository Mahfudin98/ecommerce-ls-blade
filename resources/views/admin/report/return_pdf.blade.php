<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Return PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        table, td, th {
        border: 1px solid black;
        }

        table {
        border-collapse: collapse;
        width: 100%;
        }

        th {
        height: 50px;
        }

        #footer {
            position: fixed;
            width: 100%;
            bottom: 30px;
            left: 0;
            right: 0;
        }

        #footer p {
            border-top: 2px solid #555555;
            margin-top:10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="row">
            <div class="col-md-12">
                <br>
                <img  class="img-fluid text-leaft" src="https://lh3.googleusercontent.com/d/1gqN1INphne30es-fwkqNbxkxTq2oihlN?authuser=0" width="230px">
                <div class="float-right text-right">
                    <strong>{{auth()->user()->name}}</strong> <br>
                    <strong>Retur Periode</strong><br>
                    <span style="font-size:small; color: #808080">{{ $date[0] }} - {{ $date[1] }}</span>
                </div>
            </div>
        </div>
    </nav>
    <hr>
    <table width="100%" class="table-hover table-bordered">
        <thead class="bg-dark text-white">
            <tr class="text-center">
                <th>InvoiceID</th>
                <th>Pelanggan</th>
                <th>Subtotal</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse ($orders as $row)
                <tr>
                    <td class="text-center"><strong>{{ $row->invoice }}</strong></td>
                    <td class="text-justify">
                        <strong>{{ $row->customer_name }}</strong><br>
                        <label><strong>Telp:</strong> {{ $row->customer_phone }}</label><br>
                        <label><strong>Alamat:</strong> {{ $row->customer_address }} {{ $row->customer->district->name }} - {{  $row->customer->district->city->name}}, {{ $row->customer->district->city->province->name }}</label>
                    </td>
                    <td class="text-center">Rp {{ number_format($row->subtotal) }}</td>
                    <td class="text-center">{{ $row->created_at->format('d-m-Y') }}</td>
                </tr>

                @php $total += $row->subtotal @endphp
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-center">Total</td>
                <td colspan="2" class="text-center"><strong>Rp {{ number_format($total) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div id="footer">
        <p>Retur Report | {{ $date[0] }} - {{ $date[1] }}</p>
    </div>
</body>
</html>
