@extends('template')
@section('title','Devis')
<link rel="shortcut icon" href="../../img/icons/icon-48x48.png" />
@section('content')

<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Mes Devis</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Numéro de Devis</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devis as $quote)
                            <tr>
                                <td>{{ $quote->id }}</td>
                                <td>{{ number_format($quote->total_amount, 2) }} DH</td>
                                <td>{{ $quote->date->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('detail_devis', ['type' => 'sent', 'id' => $quote->id]) }}" class="btn btn-sm btn-primary">Voir</a>
                                    <form action="{{ route('client.devis.accept', $quote->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Êtes-vous sûr de vouloir accepter ce devis?')">Accepter</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $devis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection