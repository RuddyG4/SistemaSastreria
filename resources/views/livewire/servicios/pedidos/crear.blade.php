<x-app>
    <x-slot:title>
        Crear Pedido
        </x-slot>
        <!-- Vista de creacion de pedidos -->
        <!-- INICIOOOOOOOOOOOOOOOOOO -->
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content">
                    <h1>Nuevo Pedido</h1>
                    <form id="form" action="#" class="wizard-big">
                        <h1>Caracteristicas</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h2>Descripcion de Pedido</h2>
                                    <div class="form-group" class="col-sm-10">
                                        <textarea class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="form-group" class="col-sm-10">
                                        <h2>Tipo de Pedido</h2>
                                        <div class="radio radio-info">
                                            <input type="radio" id="inlineRadio1" value="option1" name="radioInline" checked="" />
                                            <label for="inlineRadio1">
                                                PERSONAL <i class="fa fa-user"></i></label>
                                        </div>
                                        <div class="radio radio-info">
                                            <input type="radio" id="inlineRadio2" value="option2" name="radioInline" />
                                            <label for="inlineRadio2">
                                                GRUPAL <i class="fa fa-users"></i></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <h2>Encargado - Cliente</h2>
                                        <div>
                                            <select class="chosen-select" tabindex="2">
                                                <option value=""></option>
                                                <option value="United States">1</option>
                                                <option value="United Kingdom">2</option>
                                                <option value="Afghanistan">3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="margin-left: 160px">
                                        <i class="fa fa-user" style="font-size: 150px; color: #c5a2a2"></i>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <h1>Detalle Pedido</h1>
                        <fieldset>
                            <h2>Unidad de Vestimenta</h2>
                            <div class="row">
                                <div class="col-lg-8">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Vestimenta</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-danger">
                                                        <input id="checkbox1" type="checkbox" />
                                                        <label for="checkbox1"> Camisa</label>
                                                        <input id="checkbox1" type="checkbox" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <input class="editable-input" type="number" placeholder="0" style="
                                  background-color: transparent;
                                  border: none;
                                " />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-danger">
                                                        <input id="checkbox2" type="checkbox" />
                                                        <label for="checkbox2"> Pantalon</label>
                                                        <input id="checkbox2" type="checkbox" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <input class="editable-input" type="number" placeholder="0" style="
                                  background-color: transparent;
                                  border: none;
                                " />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox checkbox-danger">
                                                        <input id="checkbox3" type="checkbox" />
                                                        <label for="checkbox3"> Saco</label>
                                                        <input id="checkbox3" type="checkbox" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <input class="editable-input" type="number" placeholder="0" style="
                                  background-color: transparent;
                                  border: none;
                                " />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-2">
                                    <div style="margin-left: 50px">
                                        <i class="fa fa-male" style="font-size: 150px; color:#5135f1d5 "></i>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div>
                                        <i class="fa fa-female" style="font-size: 150px; color: #f13535d5"></i>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <h1>Detalle de Pago</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <h2>Primer Pago</h2>
                                        <input type="number" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <h2>Saldo</h2>
                                        <input type="number" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <h2>Total a Pagar</h2>
                                        <input type="number" class="form-control" disabled />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h2>Fechas de Pago</h2>
                                    <table class="table table-striped" id="data_1">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <i class="fa fa-calendar"></i> Fecha de Pago
                                                </th>
                                                <th><i class="fa fa-money"></i> Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" style="
                                    background-color: transparent;
                                    border: none;
                                  " />
                                                    </div>
                                                </td>
                                                <td>
                                                    <input class="form-control" class="editable-input" type="number" placeholder="0" style="
                                  background-color: transparent;
                                  border: none;
                                " />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" style="
                                    background-color: transparent;
                                    border: none;
                                  " />
                                                    </div>
                                                </td>
                                                <td>
                                                    <input class="form-control" class="editable-input" type="number" placeholder="0" style="
                                  background-color: transparent;
                                  border: none;
                                " />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" style="
                                    background-color: transparent;
                                    border: none;
                                  " />
                                                    </div>
                                                </td>
                                                <td>
                                                    <input class="form-control" class="editable-input" type="number" placeholder="0" style="
                                  background-color: transparent;
                                  border: none;
                                " />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </fieldset>

                        <h1>Verificar Datos</h1>
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-4">
                                    <h2 style="font-weight: bold">Caracteristicas</h2>
                                    <div class="panel panel-success">
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <h3 style="font-weight: bold">Titular</h3>
                                                <h4><i class="fa fa-user-o"></i> Fulanito Perez</h4>
                                            </div>
                                            <div class="form-group">
                                                <h3 style="font-weight: bold">Tipo de Pedido</h3>
                                                <h4><i class="fa fa-user"></i> Personal</h4>
                                            </div>
                                            <div class="form-group">
                                                <h3 style="font-weight: bold">Descripcion</h3>
                                                <h4>
                                                    <i class="fa fa-book"></i> Pedido Personal de 5
                                                    personas
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <h2 style="font-weight: bold">Detalle Pedido</h2>
                                    <div class="panel panel-success">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Masculino</th>
                                                    <th>cantidad</th>
                                                    <th>Femenino</th>
                                                    <th>Cantidad</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>camisa hombre</td>
                                                    <td>12</td>
                                                    <td>Camisa mujer</td>
                                                    <td>40</td>
                                                </tr>
                                                <tr>
                                                    <td>pantalon hombre</td>
                                                    <td>12</td>
                                                    <td>pantalon mujer</td>
                                                    <td>40</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <h2 style="font-weight: bold">Fechas de Pagos</h2>
                                    <div class="panel panel-success">
                                        <div class="col-lg-3">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <i class="fa fa-calendar"></i> Fecha de Pago
                                                        </th>
                                                        <th><i class="fa fa-money"></i> Cantidad</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>15/03/2023</td>
                                                        <td>200</td>
                                                    </tr>
                                                    <tr>
                                                        <td>15/03/2023</td>
                                                        <td>400</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button class="btn btn-outline btn-primary dim" type="button"><i class="fa fa-check"> DATOS CORRECTOS</i></button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <!-- final -->
        @push('scripts')
        <!-- Jquery Validate -->
        <script src="{{ asset('js/plugins/validate/jquery.validate.min.js') }}"></script>
        <!-- Chosen -->
        <script src="{{ asset('js/plugins/chosen/chosen.jquery.js') }}"></script>
        <!-- Steps -->
        <script src="{{ asset('js/plugins/steps/jquery.steps.min.js') }}"></script>
        <!-- iCheck -->
        <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
        <!-- Data picker -->
        <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
        <script>
            $(document).ready(function() {
                $("#wizard").steps();
                $("#form")
                    .steps({
                        bodyTag: "fieldset",
                        onStepChanging: function(event, currentIndex, newIndex) {
                            // Always allow going backward even if the current step contains invalid fields!
                            if (currentIndex > newIndex) {
                                return true;
                            }

                            // Forbid suppressing "Warning" step if the user is to young
                            if (newIndex === 3 && Number($("#age").val()) < 18) {
                                return false;
                            }

                            var form = $(this);

                            // Clean up if user went backward before
                            if (currentIndex < newIndex) {
                                // To remove error styles
                                $(".body:eq(" + newIndex + ") label.error", form).remove();
                                $(".body:eq(" + newIndex + ") .error", form).removeClass(
                                    "error"
                                );
                            }

                            // Disable validation on fields that are disabled or hidden.
                            form.validate().settings.ignore = ":disabled,:hidden";

                            // Start validation; Prevent going forward if false
                            return form.valid();
                        },
                        onStepChanged: function(event, currentIndex, priorIndex) {
                            // Suprima (omita) el paso "Advertencia" si el usuario tiene la edad suficiente.
                            if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                                $(this).steps("Next");
                            }

                            // Suprima (omita) el paso "Advertencia" si el usuario tiene la edad suficiente y desea continuar con el paso anterior.
                            if (currentIndex === 2 && priorIndex === 3) {
                                $(this).steps("Previous");
                            }
                        },
                        onFinishing: function(event, currentIndex) {
                            var form = $(this);

                            // Disable validation on fields that are disabled.
                            // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                            form.validate().settings.ignore = ":disabled";

                            // Start validation; Prevent form submission if false
                            return form.valid();
                        },
                        onFinished: function(event, currentIndex) {
                            var form = $(this);

                            // Submit form input
                            form.submit();
                        },
                    })
                    .validate({
                        errorPlacement: function(error, element) {
                            element.before(error);
                        },
                        rules: {
                            confirm: {
                                equalTo: "#password",
                            },
                        },
                    });
                $(".chosen-select").chosen({
                    width: "100%"
                });
                $(".i-checks").iCheck({
                    checkboxClass: "icheckbox_square-green",
                    radioClass: "iradio_square-green",
                });
                var mem = $("#data_1 .input-group.date").datepicker({
                    todayBtn: "linked",
                    keyboardNavigation: false,
                    forceParse: false,
                    calendarWeeks: true,
                    autoclose: true,
                });
            });
        </script>

        @endpush
</x-app>