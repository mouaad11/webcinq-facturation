@extends('template')
@section('title','Modifier le devis')
<link rel="shortcut icon" href="../../img/icons/icon-48x48.png" />
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modifier le Devis</div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('update_devis_admin', $devis->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" 
                            value="{{ old('date', $devis->date ? $devis->date->format('Y-m-d') : \Carbon\Carbon::today()->toDateString()) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="client_id" class="form-label">Client</label>
                            <select class="form-control" id="client_id" name="client_id" required>
                                <option value=""></option>
                                @foreach ($client as $item)
                                    <option value="{{ $item->id }}" {{ old('client_id', $devis->client_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="company_id" class="form-label">Informations sur la Société</label>
                            <select class="form-control" id="company_id" name="company_id" required>
                                <option value=""></option>
                                @foreach ($companyinfos as $item)
                                    <option value="{{ $item->id }}" {{ old('company_id', $devis->companyinfo_id) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }} / {{ $item->address }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">Modifier les Articles</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <select class="form-control" id="description" name="description" onchange="this.dispatchEvent(new Event('change'));">
                                        <option value="Site web statique" data-price="5000" {{ old('description', $devis->description) == 'Site web statique' ? 'selected' : '' }}>Site web statique</option>
                                        <option value="Site web dynamique" data-price="10000" {{ old('description', $devis->description) == 'Site web dynamique' ? 'selected' : '' }}>Site web dynamique</option>
                                        <option value="Ads et publicité" data-price="3000" {{ old('description', $devis->description) == 'Ads et publicité' ? 'selected' : '' }}>Ads et publicité</option>
                                        <option value="SEO" data-price="7000" {{ old('description', $devis->description) == 'SEO' ? 'selected' : '' }}>SEO</option>
                                        <option value="Maintenance" data-price="2000" {{ old('description', $devis->description) == 'Maintenance' ? 'selected' : '' }}>Maintenance</option>
                                        <option value="Autre" {{ old('description', $devis->description) == 'Autre' ? 'selected' : '' }}>Autre</option>
                                    </select>
                                    <input type="text" class="form-control mt-2" id="custom_description" name="custom_description" style="display: none;" placeholder="Veuillez spécifier" value="{{ old('custom_description', $devis->description == 'Autre' ? $devis->custom_description : '') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantité</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', 1) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="unit_price" class="form-label">Prix Unitaire (MAD)</label>
                                    <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" value="{{ old('unit_price', $devis->unit_price) }}">
                                </div>
                                <div class="mb-3">
                                    <label for="tva" class="form-label">TVA (%)</label>
                                    <input type="number" step="0.01" value="{{ old('tva', 20) }}" class="form-control" id="tva" name="tva">
                                </div>
                                <button type="button" class="btn btn-primary" id="addItem">Ajouter l'Article</button>
                            </div>
                        </div>

                        <table class="table mt-3" id="itemsTable">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Quantité</th>
                                    <th>Prix Unitaire</th>
                                    <th>TVA %</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($devis_items as $item)
                                    <tr>
                                        <td><input type="hidden" name="descriptions[]" value="{{ $item->description }}">{{ $item->description }}</td>
                                        <td><input type="hidden" name="quantities[]" value="{{ $item->quantity }}">{{ $item->quantity }}</td>
                                        <td><input type="hidden" name="unit_prices[]" value="{{ $item->unit_price }}">{{ $item->unit_price }}</td>
                                        <td><input type="hidden" name="tvas[]" value="{{ $item->tva }}">{{ $item->tva }}</td>
                                        <td><button type="button" class="btn btn-danger remove-item">Supprimer</button></td>
                                    </tr>
                                @endforeach
                                </tbody>
                        </table>

                        <button type="submit" class="btn btn-primary mt-3">Mettre à jour le Devis</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#client_id').select2({
            placeholder: "Sélectionner un client",
            allowClear: true
        });

        $('#company_id').select2({
            placeholder: "Société",
            allowClear: true
        });

        $('#description').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var selectedValue = selectedOption.val();
            if (selectedValue === "Autre") {
                $('#custom_description').show();
                $('#unit_price').val('');
            } else {
                $('#custom_description').hide();
                var price = selectedOption.data('price');
                $('#unit_price').val(price);
            }
        });

        // Trigger the change event on page load
        $('#description').trigger('change');

        $(document).on('click', '.remove-item', function() {
            $(this).closest('tr').remove();
        });
    });
    $(document).ready(function() {
    $('#addItem').on('click', function() {
        var description = $('#description').val();
        var customDescription = $('#custom_description').val();
        var quantity = $('#quantity').val();
        var unit_price = $('#unit_price').val();
        var tva = $('#tva').val();

        // If the "Autre" option is selected, use the custom description
        if (description === "Autre" && customDescription) {
            description = customDescription;
        }

        // Check that all required fields have values
        if (description && quantity && unit_price && tva) {
            var newRow = `
                <tr>
                    <td><input type="hidden" name="descriptions[]" value="${description}" >${description}</td>
                    <td><input type="hidden" name="quantities[]" value="${quantity}">${quantity}</td>
                    <td><input type="hidden" name="unit_prices[]" value="${unit_price}">${unit_price}</td>
                    <td><input type="hidden" name="tvas[]" value="${tva}">${tva}</td>
                    <td><button type="button" class="btn btn-danger remove-item">Supprimer</button></td>
                </tr>
            `;
            $('#itemsTable tbody').append(newRow);

            // Clear form fields after adding the item
            $('#description').val('');
            $('#custom_description').val('').hide();
            $('#quantity').val('1');
            $('#unit_price').val('');
            $('#tva').val('20');
        } else {
            alert('Please fill in all required fields.');
        }
    });

    // Handle removing an item
    $(document).on('click', '.remove-item', function() {
        $(this).closest('tr').remove();
    });
});

</script>

@endsection