@extends('template')

@section('title', 'Tous les Clients')
<link rel="shortcut icon" href="../../img/icons/icon-48x48.png" />

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Tous les Clients</strong></h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Liste des Clients</h5>
                </div>
                <div class="card-body">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Adresse</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>Nombre de Factures</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->address }}</td>
                                <td>{{ $client->tel }}</td>
                                <td>{{ $client->user->email }}</td>
                                <td>{{ $client->invoices_count }}</td>
                                <td>
                                   
                                    <a href="{{ route('admin_client', $client->user_id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client?')">Supprimer</button>
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