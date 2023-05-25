<?php

namespace App\Http\Livewire;

use App\Models\usuarios\Funcionalidad;
use App\Models\usuarios\Rol;



use Livewire\Component;

class Tabla extends Component
{

    public $funcion;

    public $nombre;
    public $descripcion;
    public $tipoPermiso =['ver','crear','modificar','eliminar'];
    public $permisos;
    public $checkBox = [];
    public $idEdit;
    public $afuera,$tipo,$permiso = [];
    public $show = false;
    public $showEdit = false;
    public $showDelete = false;
    public $showNew = false;
    public $contenido = '';

    // convierte a json
    public function ConverJson($array)
    {
        foreach ($array as $permiso) {
            [$objeto, $accion] = explode('.', $permiso);
            
            if (!isset($datosJson[$objeto])) {
                $datosJson[$objeto] = [];
            }
            
            $datosJson[$objeto][] = $accion;
        }
        return $datosJson;
    }

    // parte el array con datos como pedido.ver, cliente.ver en un array pedido, cliente
    public function partirString($array)
    {
        $array1 = [];
        foreach ($array as $permiso) {
        $segmentos = explode('.', $permiso);
        $array1[] = $segmentos[0];
    }
        return $array1 = array_unique($array1);
    }
    // parte los permisos de cada uno y los que se repiten apartir del .
    public function partirPermisos($array)
    {
        return array_map(function($permiso) {
            return explode('.', $permiso)[1];
        }, $array);
    }
    // obtiene los id de las funcionalidades
    public function idFuncionalidad(){
        $idNombre = Funcionalidad::get();


        foreach ($idNombre as $id) {
            if (in_array($id->nombre, $this->checkBox)) {
                $array3[] = $id->id;
            }
        }
        return $array3;
    }
    // cierra el model
    public function showoff()
    {
        $this->show = false;
        $this->showEdit = false;
        $this->showDelete = false;
        $this->showNew = false;
        $this->checkBox = [];
        $this->afuera = [];
    }

    // funciones para crear
    public function showModel()
    {   
        $partir = Funcionalidad::pluck('nombre');
        $this->permisos = $this->partirString($partir);

        $this->nombre =  '';
        $this->descripcion = '';
        $this->contenido = 'Crear Rol';
        
        $this->showNew = true;
    }
    public function savedato()
    {
        $rol = Rol::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion
        ]);
        $funcionId = $this->idFuncionalidad();
        $rol->funcionalidades()->attach($funcionId);


        $this->checkBox = [];
        $this->showNew = false;
        $this->clearForm();
    }


    // funciones para editar
    public function editar($id)
    {

        $rol = Rol::findOrFail($id);
        $nuevo = $rol->funcionalidades()->select('permiso_rol.*')->get();
        foreach($nuevo as $n){
            if ($n->id_rol == $id){
                $permisosId[] = $n->id_funcionalidad;
            }
        }
        $permisosList = Funcionalidad::whereIn('id', $permisosId)->pluck('nombre');
        foreach($permisosList as $permisos){
           $convertir[] = $permisos;
        }
        $this->tipo = $this->ConverJson($convertir);

        $this->contenido = "Editar Rol";
        $this->showEdit = true;
    }

    public function saveEdit()
    {
        $rol = Rol::find($this->idEdit);
        $rol->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);
        $this->show = false;
        $this->showEdit = false;
        $this->clearForm();
    }

    // funciones para eliminar
    public function deleteRol($id)
    {   
        $this->idEdit = $id;
        $this->contenido = 'Elimiar Rol';
        $this->showDelete= true;
    }

    public function Delete()
    {
        $rol = Rol::find($this->idEdit);
        if ($rol) {
            $rol->funcionalidades()->detach();
            $rol->delete($this->idEdit);
        }
        $this->showDelete = false;
    }

    // funcion para ver los datos
    public function ver($id)
    {   
        $rol = Rol::findOrFail($id);
        $nuevo = $rol->funcionalidades()->select('permiso_rol.*')->get();
        foreach($nuevo as $n){
            if ($n->id_rol == $id){
                $permisosId[] = $n->id_funcionalidad;
            }
        }
        $permisosList = Funcionalidad::whereIn('id', $permisosId)->pluck('nombre');
        foreach($permisosList as $permisos){
           $convertir[] = $permisos;
        }
        $this->tipo = $this->ConverJson($convertir);
        $this->show = true;
        $this->contenido = "Ver Permisos";
    }

    public function clearForm()
    {
        $this->nombre='';
        $this->descripcion='';
    }
    public function render()
    {
        $roles = Rol::paginate(10);
        return view('livewire.tabla',compact('roles'));
    }


}
