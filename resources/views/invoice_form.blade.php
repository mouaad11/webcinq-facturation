@extends('template')
@section('title', 'Ajouter une facture')
<link rel="shortcut icon" href="../img/icons/icon-48x48.png" />

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informations de la Facture</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{route('save_invoice_admin')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" value="{{ \Carbon\Carbon::today()->toDateString() }}" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Date d'échéance</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="client_id" class="form-label">Client</label>
                            <select class="form-control" id="client_id" name="client_id" required>
                                <option value=""></option> 
                                @foreach($client as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="company_id" class="form-label">Informations sur la société</label>
                            <select class="form-control" id="company_id" name="company_id" required>
                                <option value=""></option>
                                @foreach($companyinfo as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} / {{$item->address }}  </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="status" class="form-label">Statut</label>
                            <select class="form-control" id="status" name="status">
                                <option value="unpaid">Non payé</option>
                                <option value="paid">Payé</option>
                            </select>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">Ajouter un Article à la Facture</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <select class="form-control" id="description" name="description" onchange="this.dispatchEvent(new Event('change'));">
                                        <option value="Site web statique" data-price="5000">Site web statique</option>
                                        <option value="Site web dynamique" data-price="10000">Site web dynamique</option>
                                        <option value="Ads et publicité" data-price="3000">Ads et publicité</option>
                                        <option value="SEO" data-price="7000">SEO</option>
                                        <option value="Maintenance" data-price="2000">Maintenance</option>
                                        <option value="Autre">Autre</option>
                                    </select>
                                    <input type="text" class="form-control mt-2" id="custom_description" name="custom_description" style="display:none;" placeholder="Veuillez spécifier">
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantité</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="1" >
                                </div>
                                <div class="mb-3">
                                    <label for="unit_price" class="form-label">Prix Unitaire (MAD)</label>
                                    <input type="number" step="0.01" class="form-control" id="unit_price" name="unit_price" >
                                </div>
                                <div class="mb-3">
                                    <label for="tva" class="form-label">TVA (%)</label>
                                    <input type="number" step="0.01" value="20" class="form-control" id="tva" name="tva" >
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
                                <!-- Les articles seront ajoutés ici -->
                            </tbody>
                        </table>
                     
                        <button type="submit" class="btn btn-primary mt-3">Enregistrer la Facture</button>
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

        $('#addItem').on('click', function() {
            var description = $('#description').val();
            var customDescription = $('#custom_description').val();
            var quantity = $('#quantity').val();
            var unit_price = $('#unit_price').val();
            var tva = $('#tva').val();

            if (description === "Autre" && customDescription) {
                description = customDescription;
            }

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
                
                // Effacer les champs du formulaire
                $('#description').val('');
                $('#custom_description').val('').hide();
                $('#quantity').val('1');
                $('#unit_price').val('');
                $('#tva').val('');
            }
        });

        $(document).on('click', '.remove-item', function() {
            $(this).closest('tr').remove();
        });
    });
</script>

@endsection
