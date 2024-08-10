@extends('template')

@section('contenu')
    <div class="container">
        <h1 class="mt-4">Liste des Devis</h1>

        @if($devisList->isEmpty())
            <p>Aucun devis n'a été trouvé.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($devisList as $devis)
                        <tr>
                            <td>{{ $devis->id }}</td>
                            <td>{{ $devis->client->name }}</td>
                            <td>{{ $devis->date }}</td>
                            <td>{{ number_format($devis->total, 2) }} MAD</td>
                            <td>
                                <a href="{{ route('devis.show', $devis->id) }}" class="btn btn-primary btn-sm">Voir</a>
                                <a href="{{ route('devis.edit', $devis->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                <form action="{{ route('devis.destroy', $devis->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
