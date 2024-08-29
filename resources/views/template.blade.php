<!DOCTYPE html>

<body>

@auth
    @include('nav')

    @if (Auth::user()->uservalid === 'v')
       
    @else
        <h1>Attente de validation du compte</h1>
    @endif

@endauth

</body>
</html>