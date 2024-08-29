<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devis</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 30px ;
            padding: 20px;
            position: relative;
            min-height: 100vh;
        }
        .devis-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .devis-header img {
            max-width: 200px;
        }
        .devis-title {
            font-size: 24px;
            font-weight: bold;
            margin: 10px 0;
        }
        .devis-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .company-details {
            text-align: right;
        }
        .devis-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .devis-table th, .devis-table td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        .devis-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .devis-total {
            text-align: right;
        }
        .devis-total p {
            margin: 5px 0;
        }
        .devis-total .total-amount {
            font-size: 18px;
            font-weight: bold;
        }
        .devis-footer {
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
    <div class="devis-header">
         <div class="devis-title">
            DEVIS n° 
            @if ($type === 'sent')
                {{$devis->id}}
            @else
                {{$devis->id}}
            @endif
        </div>
    </div>

    <div class="devis-details">
        <div class="client-details">
            @if ($type === 'sent')
                <h3>{{$client->name}}</h3>
                <p>{{$client->address}}</p>
                <p>Tél: {{$client->tel}}</p>
            @else
                <h3>{{$client->name}}</h3>
                <p>{{$client->address}}</p>
                <p>Tél: {{$client->tel}}</p>
            @endif
        </div>
        <div class="company-details">
            @if ($type === 'sent')
                <h3>{{$company->name}}</h3>
                <p>{{$company->address}}</p>
                <p>{{$company->city}}</p>
                <p>Tél: {{$company->tel}}</p>
                <p>Email: {{$company->email}}</p>
            @else
                <h3>{{$company->name}}</h3>
                <p>{{$company->address}}</p>
                <p>{{$company->city}}</p>
                <p>Tél: {{$company->tel}}</p>
                <p>Email: {{$company->email}}</p>
            @endif
        </div>
    </div>

    <table class="devis-table">
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
            @foreach ($devis_item as $key => $item)
                <tr>
                    <td>{{$item->description}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->unit_price}} DH</td>
                    <td>{{$item->tva}}% <br><small>({{$tva_array[$key]}} DH)</small></td>
                    <td>{{$totals[$key]}} DH</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="devis-total">
        <p>Total net HT: <span>{{$total_net}} DH</span></p>
        <p>Total TVA: <span>{{$total_tva}} DH</span></p>
        <p class="total-amount">Montant total TTC: <span>{{$ttc}} DH</span></p>
    </div>

    <div class="devis-footer">
        <p>Merci pour votre confiance. Pour toute question, n'hésitez pas à nous contacter.</p>
    </div>
</body>
</html>