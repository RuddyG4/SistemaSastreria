<ul>
    @foreach($usuarios as $usuario)
    <li>{{ $usuario->username}}</li>
    @endforeach
</ul>