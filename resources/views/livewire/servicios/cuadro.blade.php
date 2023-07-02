<x-slot:title>
    cuadro
    </x-slot>

    <div>

        {{var_export($currentPositions)}}
        <script src="{{ asset('js\jquery-3.7.0.min.js') }}"></script>
        {{-- <p id="position"></p>
        <div id="draggableElement" class="draggable">Arrástrame</div> --}}


        <div id="cuadro" style="width: 500px; height: 500px; border: 1px solid black; position: relative;">
            @foreach ($nueva as $n)
            <div id="draggableElement-{{$n->id}}" class="draggable btn-group me-2" data-id="{{$n->id}}">
                <label class="d-flex align-items-center justify-content-center px-2 text-bg-dark">{{$n->nombre}}</label>
            </div>
            @endforeach
        </div>

        <button id="guardarBtn" class="btn btn-primary">Guardar posiciones</button>


        <p id="position"></p>


        {{-- 
        <script>
            $(document).ready(function() {
                var collection = [{
                        id: 1,
                        posX: 0,
                        posY: 0
                    },
                    {
                        id: 2,
                        posX: 0,
                        posY: 0
                    },
                    {
                        id: 3,
                        posX: 0,
                        posY: 0
                    },
                    {
                        id: 4,
                        posX: 0,
                        posY: 0
                    },
                    {
                        id: 5,
                        posX: 0,
                        posY: 0
                    },
                ];

                $(".draggable").draggable({
                    containment: cuadro,
                    start: function(event, ui) {
                        var id = $(this).data("id");
                        var element = collection.find(item => item.id === id);
                        if (element) {
                            $("#position").text("Posición inicial: left: " + element.posX + ", top: " +
                                element.posY);
                        }
                    },
                    drag: function(event, ui) {
                        var id = $(this).data("id");
                        var element = collection.find(item => item.id === id);
                        if (element) {
                            element.posX = ui.position.left;
                            element.posY = ui.position.top;
                            $("#position").text("Posición actual: left: " + element.posX + ", top: " +
                                element.posY);
                        }
                    }
                });
            });
        </script> --}}

    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {

            var currentPosition = {}; // Almacena las posiciones actuales de los elementos

            $(".draggable").draggable({
                containment: "#cuadro",
                start: function(event, ui) {
                    var id = $(this).data("id");
                    var posX = 0;
                    var posY = 0;
                    // Obtener los valores de posición desde la base de datos 
                    // Asigna los valores de posición a posX y posY

                    currentPosition[id] = {
                        posX: posX,
                        posY: posY
                    };

                    $("#position").text("Posición inicial: left: " + posX + ", top: " + posY);
                },
                drag: function(event, ui) {
                    var id = $(this).data("id");
                    var posX = ui.position.left;
                    var posY = ui.position.top;

                    currentPosition[id] = {
                        posX: posX,
                        posY: posY
                    };

                    $("#position").text("Posición actual: left: " + posX + ", top: " + posY);
                },
                stop: function(event, ui) {
                    // No se realiza ninguna acción aquí, ya que la actualización se hará al hacer clic en el botón de guardar
                }
            });

            $("#guardarBtn").click(function() {
                Livewire.emit('guardarPosiciones', currentPosition);
            });

        });
    </script>
    @endpush