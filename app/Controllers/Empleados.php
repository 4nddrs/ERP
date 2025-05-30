<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpleadoModel;

class Empleados extends BaseController
{
    protected $empleadoModel;

    public function __construct()
    {
        $this->empleadoModel = new EmpleadoModel();
    }

    public function index()
    {
        $data['empleados'] = $this->empleadoModel->orderBy('id', 'DESC')->findAll();

        return view('empleados/index', $data);
    }
    

    public function new()
    {
        return view('empleados/new');
    }

    public function create()
    {
        $data = $this->request->getPost();

        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|valid_email|is_unique[empleados.correo]',
            'telefono' => 'required|numeric',
            'direccion' => 'required',
            'sueldo' => 'required|decimal',
            'horas_trabajo_semana' => 'required|integer',
            'cargo' => 'required',
            'departamento' => 'required',
            'fecha_nacimiento' => 'required|valid_date',
            'fecha_ingreso' => 'required|valid_date',
            'estado' => 'required|in_list[activo,inactivo,licencia,suspendido]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->empleadoModel->save($data);

        return redirect()->to('/empleados')->with('msg', 'Empleado creado con éxito');
    }

    // Mostrar formulario para editar empleado
    public function edit($id)
    {
        $empleado = $this->empleadoModel->find($id);
        if (!$empleado) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Empleado no encontrado");
        }

        return view('empleados/edit', ['empleado' => $empleado]);
    }

    // Actualizar empleado existente
    public function update($id = null)
    {
        helper(['form']);
    
        if ($id === null) {
            return redirect()->to('/empleados')->with('error', 'ID inválido');
        }
    
        $data = $this->request->getPost();
    
        // Solo validamos nombre y apellido
        $rules = [
            'nombre' => 'required',
            'apellido' => 'required',
        ];
    
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $empleadoData = [
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'correo' => $data['correo'] ?? null,   // quitar validación pero enviar si viene
            'telefono' => $data['telefono'] ?? null,
            'direccion' => $data['direccion'] ?? null,
            'fecha_nacimiento' => $data['fecha_nacimiento'] ?? null,
            'fecha_ingreso' => $data['fecha_ingreso'] ?? null,
            'cargo' => $data['cargo'] ?? null,
            'departamento' => $data['departamento'] ?? null,
            'sueldo' => $data['sueldo'] ?? null,
            'horas_trabajo_semana' => $data['horas_trabajo_semana'] ?? null,
            'estado' => $data['estado'] ?? null,
        ];
    
        log_message('info', 'Actualizando empleado ID=' . $id . ' con datos: ' . json_encode($empleadoData));
    
        $empleadoModel = new \App\Models\EmpleadoModel();
    
        $updated = $empleadoModel->update($id, $empleadoData);
    
        if ($updated === false) {
            $errors = $empleadoModel->errors();
            log_message('error', 'Error al actualizar empleado ID=' . $id . ': ' . json_encode($errors));
            return redirect()->back()->with('error', 'No se pudo actualizar el empleado. ' . implode(', ', $errors));
        }
    
        return redirect()->to('/empleados')->with('message', 'Empleado actualizado correctamente');
    }
    

    

    // Eliminar empleado
    public function delete($id)
    {
        $this->empleadoModel->delete($id);
        return redirect()->to('/empleados')->with('msg', 'Empleado eliminado');
    }
}
