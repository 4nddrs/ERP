<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpleadosModel extends Model
{
    protected $table      = 'empleados';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['identidad', 'nombre', 'apellido', 'telefono', 'direccion', 'cargo', 'salario', 'activo', 'id_sucursal'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';

    public function buscarEmpleado($empleado = '', $id_sucursal)
    {
        $empleado = $this->escapeLikeString($empleado);

        $query = $this->select('id, identidad, nombre, apellido, telefono, cargo')
            ->where(['activo' => 1, 'id_sucursal' => $id_sucursal])
            ->groupStart()
            ->like('identidad', $empleado)
            ->orLike('nombre', $empleado)
            ->groupEnd()
            ->limit(10)
            ->get();

        return $query->getResultArray();
    }
}

