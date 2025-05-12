<?php

namespace App\Controllers;

use App\Models\EmpleadosModel;
use App\Models\SucursalModel;

class Empleados extends BaseController
{
    protected $empleadosModel, $sucursalModel;

    public function __construct()
    {
        $this->empleadosModel = new EmpleadosModel();
        $this->sucursalModel = new SucursalModel();
        helper(['form']);
    }

    // Catálogo de empleados
    public function index()
    {
        if (!verificar('empleados', $_SESSION['permisos'])) {
            return redirect()->to(base_url('inicio'));
        }

        $empleados = $this->empleadosModel
            ->select('empleados.*, sucursal.nombre AS sucursal')
            ->join('sucursal', 'empleados.id_sucursal = sucursal.id')
            ->where('empleados.activo', 1)
            ->findAll();

        return view('empleados/index', ['empleados' => $empleados]);
    }

    // Mostrar formulario nuevo
    public function new()
    {
        if (!verificar('empleados', $_SESSION['permisos'])) {
            return redirect()->to(base_url('inicio'));
        }

        $data['sucursales'] = $this->sucursalModel->where('activo', 1)->findAll();
        return view('empleados/new', $data);
    }

    // Crear nuevo empleado
    public function create()
    {
        $reglas = [
            'identidad' => 'required|is_unique[empleados.identidad]',
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'cargo' => 'required',
            'salario' => 'required|decimal',
            'id_sucursal' => 'required|numeric'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $post = $this->request->getPost([
            'identidad', 'nombre', 'apellido', 'telefono', 'direccion', 'cargo', 'salario', 'id_sucursal'
        ]);

        $this->empleadosModel->insert([
            ...$post,
            'activo' => 1
        ]);

        return redirect()->to('empleados');
    }

    // Formulario de edición
    public function edit($id = null)
    {
        if (!verificar('empleados', $_SESSION['permisos'])) {
            return redirect()->to(base_url('inicio'));
        }

        if ($id == null) {
            return redirect()->to('empleados');
        }

        $data['empleado'] = $this->empleadosModel->find($id);
        $data['sucursales'] = $this->sucursalModel->where('activo', 1)->findAll();

        return view('empleados/edit', $data);
    }

    // Actualizar empleado
    public function update($id = null)
    {
        if ($id == null) {
            return redirect()->to('empleados');
        }

        $reglas = [
            'identidad' => "required|is_unique[empleados.identidad,id,{$id}]",
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'cargo' => 'required',
            'salario' => 'required|decimal',
            'id_sucursal' => 'required|numeric'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $post = $this->request->getPost([
            'identidad', 'nombre', 'apellido', 'telefono', 'direccion', 'cargo', 'salario', 'id_sucursal'
        ]);

        $this->empleadosModel->update($id, $post);

        return redirect()->to('empleados');
    }

    // Eliminar empleado (baja lógica)
    public function delete($id = null)
    {
        if (!verificar('empleados', $_SESSION['permisos'])) {
            return redirect()->to(base_url('inicio'));
        }

        if ($id !== null) {
            $this->empleadosModel->update($id, ['activo' => 0]);
        }

        return redirect()->to('empleados');
    }
}

