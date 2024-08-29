<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <title>Facture</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 200px;
            height: auto;
        }
        .invoice-number {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
            margin-top: 10px;
        }
        .company-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .right-align {
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #2c3e50;
        }
        .totals {
            text-align: right;
        }
        .totals p {
            margin: 5px 0;
        }
        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }
        .footer {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="invoice-number">
            FACTURE n°
            @if ($type === 'sent')
                {{$invoice->id}}
            @else
                {{$invoice->id}}
            @endif
        </div>
    </div>

    <div class="company-details">
        <div>
            @if ($type === 'sent')
                <h2>{{$client->name}}</h2>   
                <p>{{$client->address}}</p> 
                <p>{{$client->tel}}</p> 
            @else
                <h3>{{$company->name}}</h3>   
                <p>{{$company->address}}</p> 
                <p>{{$company->city}}</p> 
                <p>{{$company->tel}}</p> 
                <p>{{$company->email}}</p> 
            @endif
        </div>
        <div class="right-align">
            @if ($type === 'sent')
                <h2>{{$company->name}}</h2>   
                <p>{{$company->address}}</p> 
                <p>{{$company->city}}</p> 
                <p>{{$company->tel}}</p> 
                <p>{{$company->email}}</p> 
            @else
                <h3>{{$client->name}}</h3>   
                <p>{{$client->address}}</p> 
                <p>{{$client->tel}}</p> 
            @endif
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Qté</th>
                <th>Prix unitaire HT</th>
                <th>TVA</th>
                <th>Total HT</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice_item as $key => $item)
                <tr>
                    <td>{{$item->description}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->unit_price}}</td>
                    <td>{{$item->tva}}% <br><i>({{$tva_array[$key]}})</i></td>
                    <td>{{$totals[$key]}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totals">
        <p>Total net HT: <span class="total-amount">{{$total_net}} DH</span></p>
        <p>Total TVA: <span class="total-amount">{{$total_tva}} DH</span></p>
        <p>Montant total TTC: <span class="total-amount">{{$ttc}} DH</span></p>
    </div>

    <div class="footer">
        <p>Merci pour votre confiance. Pour toute question, n'hésitez pas à nous contacter.</p>
    </div>
</body>
</html>