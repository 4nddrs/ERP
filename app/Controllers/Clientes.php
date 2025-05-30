<?php

namespace App\Controllers;

use App\Models\ClientesModel;

class Clientes extends BaseController
{
    protected $clientesModel;

    public function __construct()
    {
        $this->clientesModel = new ClientesModel();
        helper(['form']);
        
    }

    // Cargar catálogo de clientes
    public function index()
    {
        if (!verificar('clientes', $_SESSION['permisos'])) {
            return redirect()->to(base_url('inicio'));
        }
        $clientes = $this->clientesModel->where(['activo' => 1, 'id_sucursal' => $this->session->get('id_sucursal')])->findAll();
        return view('clientes/index', ['clientes' => $clientes]);
    }

    // Mostrar formulario nuevo
    public function new()
    {
        if (!verificar('clientes', $_SESSION['permisos'])) {
            return redirect()->to(base_url('inicio'));
        }
        return view('clientes/new');
    }

    // Valida e inserta nuevo registro
    public function create()
    {
        $reglas = [
            'identidad' => 'required|unique_sucursal[clientes.identidad]',
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required|numeric|unique_sucursal[clientes.telefono]',
            'direccion' => 'required'
        ];

        if (!$this->validate($reglas)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
        }

        $post = $this->request->getPost(['identidad', 'nombre', 'apellido', 'telefono', 'direccion']);
        $this->clientesModel->insert([
            'identidad'        => $post['identidad'],
            'nombre'        => $post['nombre'],
            'apellido'        => $post['apellido'],
            'telefono' => $post['telefono'],
            'direccion'    => $post['direccion'],
            'activo'        => 1,
            'id_sucursal'        => $this->session->get('id_sucursal')
        ]);

        return redirect()->to('clientes');
    }

    // Cargar vista editar
    public function edit($id = null)
    {
        if (!verificar('clientes', $_SESSION['permisos'])) {
            return redirect()->to(base_url('inicio'));
        }
        if ($id == null) {
            return redirect()->to('clientes');
        }

        $cliente = $this->clientesModel->find($id);
        return view('clientes/edit', ['cliente' => $cliente]);
    }

    // Valida y actualiza registro
    public function update($id)
    {
        // Obtener datos enviados por POST
        $post = $this->request->getPost();
    
        // Obtener empleado actual para comparación de correo
        $actual = $this->empleadoModel->find($id);
        if (!$actual) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Empleado con ID $id no encontrado");
        }
    
        // Definir reglas de validación
        $rules = [
            'nombre'              => 'required|string|max_length[255]',
            'apellido'            => 'required|string|max_length[255]',
            'telefono'            => 'permit_empty|alpha_numeric_punct|max_length[20]',
            'direccion'           => 'permit_empty|string|max_length[500]',
            'fecha_nacimiento'    => 'required|valid_date',
            'fecha_ingreso'       => 'required|valid_date',
            'cargo'               => 'required|string|max_length[100]',
            'departamento'        => 'required|string|max_length[100]',
            'sueldo'              => 'required|decimal',
            'horas_trabajo_semana'=> 'required|integer|greater_than[0]',
            'estado'              => 'required|in_list[activo,inactivo,licencia,suspendido]',
        ];
    
        // Validar correo: si cambió, validar unicidad
        if (isset($post['correo'])) {
            if ($post['correo'] !== $actual['correo']) {
                $rules['correo'] = 'required|valid_email|is_unique[empleados.correo]';
            } else {
                $rules['correo'] = 'required|valid_email';
            }
        }
    
        // Validar datos
        if (! $this->validate($rules)) {
            return redirect()->back()
                             ->withInput()
                             ->with('errors', $this->validator->getErrors());
        }
    
        // Actualizar empleado (se recomienda pasar solo los campos que permites)
        $updateData = [
            'nombre'               => $post['nombre'],
            'apellido'             => $post['apellido'],
            'correo'               => $post['correo'],
            'telefono'             => $post['telefono'],
            'direccion'            => $post['direccion'],
            'fecha_nacimiento'     => $post['fecha_nacimiento'],
            'fecha_ingreso'        => $post['fecha_ingreso'],
            'cargo'                => $post['cargo'],
            'departamento'         => $post['departamento'],
            'sueldo'               => $post['sueldo'],
            'horas_trabajo_semana' => $post['horas_trabajo_semana'],
            'estado'               => $post['estado'],
        ];
    
        $this->empleadoModel->update($id, $updateData);
    
        return redirect()->to('/empleados')->with('msg', 'Empleado actualizado con éxito');
    }
    

    // Elimina cliente
    public function delete($id = null)
    {
        if (!verificar('clientes', $_SESSION['permisos'])) {
            return redirect()->to(base_url('inicio'));
        }
        if (!$id == null) {
            $this->clientesModel->update($id, [
                'activo' => 0
            ]);
        }

        return redirect()->to('clientes');
    }

    // Función para autocompletado de clientes
    public function autocompleteData()
    {
        $resultado = array();

        $valor = $this->request->getGet('term');

        $clientes = $this->clientesModel->buscarCliente($valor, $this->session->get('id_sucursal'));

        if (!empty($clientes)) {
            foreach ($clientes as $cliente) {
                $data['id']    = $cliente['id'];
                $data['value'] = $cliente['identidad'];
                $data['label'] = $cliente['nombre'] . ' ' . $cliente['apellido'];
                $data['telefono'] = $cliente['telefono'];
                array_push($resultado, $data);
            }
        }

        echo json_encode($resultado);
    }
}
