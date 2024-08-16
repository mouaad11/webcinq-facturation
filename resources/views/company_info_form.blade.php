@extends('template')


@section('title', 'Toutes les entreprises') 
<link rel="shortcut icon" href="../img/icons/icon-48x48.png" />

@section('content')

    <button id="showCompanyFormBtn" class="btn btn-secondary mt-3">Ajouter des informations sur l'entreprise</button>

    <div class="container" style="display: none;" id="companyFormContainer">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Informations sur l'entreprise</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('company_info_save') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Ville</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Numéro de téléphone</label>
                                <input type="text" class="form-control" id="phone_number" name="tel" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Enregistrer les informations de l'entreprise</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Informations sur l'entreprise</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Ville</th>
                                    <th>Téléphone</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companyInfo as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>{{ $item->city }}</td>
                                        <td>{{ $item->tel }}</td>
                                        <td>{{ $item->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    document.getElementById('showCompanyFormBtn').addEventListener('click', function() {
        var companyFormContainer = document.getElementById('companyFormContainer');
        if (companyFormContainer.style.display === "none") {
            companyFormContainer.style.display = "block";
            this.textContent = "Cacher le formulaire d'informations sur l'entreprise";
        } else {
            companyFormContainer.style.display = "none";
            this.textContent = "Ajouter des informations sur l'entreprise";
        }
    });
</script>

@endsection
