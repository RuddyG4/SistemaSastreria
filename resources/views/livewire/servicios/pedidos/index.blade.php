<x-app>
    <x-slot:title>
        Pedidos
        </x-slot>
        <div>
            <div class="ibox-content m-b-sm border-bottom">
                <div class="forum-item active">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="forum-icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <a href="forum_post.html" class="forum-item-title">Gestionar Pedidos</a>
                            <div class="forum-sub-title">Crear, Editar y Ver Pedidos.</div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                {{ $totalPedidos }}
                            </span>
                            <div>
                                <small>Total Pedidos</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                {{ $pedidosPendientes }}
                            </span>
                            <div>
                                <small>Pendientes</small>
                            </div>
                        </div>
                        <div class="col-md-1 forum-info">
                            <span class="views-number">
                                {{ ($totalPedidos - $pedidosPendientes) }}
                            </span>
                            <div>
                                <small>Completados</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FIN TITULO -->
            
            <livewire:servicios.pedidos.tabla-pedidos />

        </div>
</x-app>