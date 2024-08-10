@extends('template')

@section('contenu')
    <div class="container">
        <h1>Invoices</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client Name</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->client->name }}</td>
                        <td>{{ $invoice->amount }}</td>
                        <td>
                            <a href="{{ route('invoices.show', $invoice->id) }}">View</a>
                            <a href="{{ route('invoices.edit', $invoice->id) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
