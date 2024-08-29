@extends('template')

@section('title', 'Tous les Devis')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Tous les Devis</strong></h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
                @endif
                <div class="card-header">
                    <h5 class="card-title mb-0">Liste des Devis</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Numéro de Devis</th>
                                <th>Client</th>
                                <th>Entreprise</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($devisList as $quote)
                            <tr>
                                <td>{{ $quote->id }}</td>
                                <td>{{ $quote->client->name }}</td>
                                <td>{{ $quote->companyinfo->name }}</td>
                                <td>{{ number_format($quote->total_amount, 2) }} DH</td>
                                <td>{{ $quote->date instanceof \Carbon\Carbon ? $quote->date->format('d/m/Y') : $quote->date }}</td>
                                <td>
                                    @if ($quote->status == 'Accepté')
                                        <span class="badge bg-success">{{ $quote->status }}</span>
                                    @else
                                        <span class="badge bg-danger">{{ $quote->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('detail_devis', ['type' => 'sent', 'id' => $quote->id]) }}" class="btn btn-sm btn-primary">Voir</a>
                                    @if ($quote->status == 'Non Accepté')
                                    <form action="{{ route('client.devis.accept', $quote->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Êtes-vous sûr de vouloir accepter ce devis?')">Accepter</button>
                                    </form>
                                    @endif
                                    <a href="{{ route('devis.edit', $quote->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                    <form action="{{ route('devis.destroy', $quote->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce devis?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection