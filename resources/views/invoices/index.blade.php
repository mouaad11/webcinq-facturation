@extends('template')


@section('title', 'Toutes les Factures')  <!-- This will set the page title -->

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Toutes les Factures</strong></h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Liste des Factures</h5>
                </div>
                <div class="card-body">
                    <label for="filter-type" class="form-label">Filtrer par type</label>
                    <select class="form-control" id="filter-type">
                        <option value="">Tous</option>
                        <option value="envoyée">Envoyée</option>
                        <option value="reçu">Reçu</option>
                    </select>
                </div>
                <div class="card-body">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Type</th>
                                <th>Client</th>
                                <th>Entreprise</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Échéance</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->type }}</td>
                                <td>{{ $invoice->client->name }}</td>
                                <td>{{ $invoice->companyinfo->name }}</td>
                                <td>{{ number_format($invoice->total_amount, 2) }} DH</td>
                                <td>{{ $invoice->date instanceof \Carbon\Carbon ? $invoice->date->format('d/m/Y') : $invoice->date }}</td>
                                <td>{{ $invoice->due_date instanceof \Carbon\Carbon ? $invoice->due_date->format('d/m/Y') : $invoice->due_date }}</td>
                                <td>
                                    <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : 'danger' }}">
                                        {{ $invoice->status == 'paid' ? 'Payée' : 'Non payée' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('detail_invoice', ['type' => 'sent', 'id' => $invoice->id]) }}" class="btn btn-sm btn-primary">Voir</a>
                                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                    <form action="{{ route('invoices.destroy', $invoice->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette facture?')">Supprimer</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#filter-type').on('change', function() {
        var type = $(this).val();
        if (type) {
            $('table tbody tr').hide();
            $('table tbody tr').filter(function() {
                return $(this).find('td:eq(1)').text().trim() === type;
            }).show();
        } else {
            $('table tbody tr').show();
        }
    });
});
</script>
@endsection
