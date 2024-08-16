<!-- resources/views/companies/index.blade.php
THIS VIEW IS NOT CURRENTLY BEING USED
-->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Companies</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->address }}</td>
                        <td>
                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
