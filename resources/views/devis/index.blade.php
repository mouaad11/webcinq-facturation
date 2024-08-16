@extends('template')

@section('title', 'Tous les Devis')
<link rel="shortcut icon" href="../../img/icons/icon-48x48.png" />

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Tous les Devis</strong></h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
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
                                    <a href="{{ route('detail_devis', ['type' => 'sent', 'id' => $quote->id]) }}" class="btn btn-sm btn-primary">Voir</a>
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