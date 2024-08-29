@extends('template')
@section('title', 'Liste de validation')
@section('content')


<style>
    table{
        border: 1px solid white;
        border-collapse: collapse;
    }
        
    .toggle-button {
        position: relative;
        width: 60px;
        height: 20px;
        background-color: red;
        border-radius: 20px;
        border: 2px solid black;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .toggle-button .toggle-circle {
        position: absolute;
        width: 17px;
        height: 17px;
        background-color: black;
        border-radius: 50%;
       
    }
    .toggle-button.on {
        background-color: green;
    }
    .toggle-button.on .toggle-circle {
        transform: translateX(40px);
    }
</style>

<h2>Liste de validation</h2><br>
<div class="container d-flex justify-content-center">
    <form class="d-flex w-auto mx-auto" method="POST" action="{{route('search_users_email')}}">
        @csrf
        
      <input class="form-control me-2" type="search" placeholder="Rechercher par email" aria-label="Search " name="email">
      <button class="btn btn-outline-success" type="submit">Rechercher</button>
    </form>
  </div>
  <br>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nom</th>
            <th scope="col">Email</th>
            <th scope="col">Date de création</th>
            <th scope="col">Validation</th>
            <th scope="col">Informations sur le client</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $item)
        @if ($item->isClient())
        <tr>
            <th scope="row">{{ $item->id }}</th>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->created_at }}</td>
            <td>
                <span class="validation">{{ $item->uservalid }}</span>

                <form class="toggleForm" action="{{ route('validation_change', ['user'=> $item->id]) }}" method="POST">
                    @csrf
                    <div class="toggleButton toggle-button" id="{{$item->id}}">
                        <div class="toggle-circle" ></div>
                    </div>
                </form>
            </td>

            <td>
                <form action="{{ route('admin_client',['id'=> $item->id])  }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-info btn-sm mx-4">Infos client</button>
                </form>
                


            </td>
            <td class="col-3">
                
                <form action="{{ route('delete_account', ['user'=> $item->id]) }}" method="POST" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                </form>
            </td>
        </tr>
            
        @endif
        @endforeach
        
    </tbody>
</table>




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButtons = document.querySelectorAll('.toggleButton');
        const validations = document.querySelectorAll('.validation');
        const toggleForms = document.querySelectorAll('.toggleForm');

        toggleButtons.forEach((toggleButton, index) => {
            const validation = validations[index].textContent.trim();

            if (validation === 'v') {
                toggleButton.classList.add('on');
            }

            toggleButton.addEventListener('click', function() {
                $.ajax({
                    url: toggleForms[index].action,
                    type: 'POST',
                 //   data: $(toggleForms[index]).serialize(), 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Réponse du serveur :', response);
                      
                        if (response.validation === 'v') {
                            toggleButton.classList.add('on');
                            validations[index].textContent = 'v'; 
                        } else {
                            toggleButton.classList.remove('on');
                            validations[index].textContent = 'nv'; 
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Erreur AJAX:', error);
                    }
                   
                });
            });
        });
      
    });
</script>

@endsection
