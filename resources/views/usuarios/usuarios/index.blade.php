<ul>
    @foreach($usuarios as $usuario)
    <li>{{ $usuario->username}}</li>
    @endforeach
</ul>

<button> <a href="{{url('/dashboard')}}" >pagina principal</a> </button>