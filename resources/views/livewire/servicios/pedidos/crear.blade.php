<x-app>
    <x-slot:title>
        Crear Pedido
        </x-slot>
        <!-- Vista de creacion de pedidos -->
        <!-- INICIO -->
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content">
                    <h1>Nuevo Pedido</h1>
                    <livewire:servicios.pedidos.crear-pedido />
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