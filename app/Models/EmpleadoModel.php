<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpleadoModel extends Model
{
    protected $table = 'empleado';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nombre',
        'apellido',
        'correo',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'fecha_ingreso',
        'cargo',
        'departamento',
        'sueldo',
        'horas_trabajo_semana',
        'estado'
    ];

    protected $useTimestamps = false; // No usamos created_at ni updated_at

    protected $validationRules = [
        'nombre' => 'required|string|max_length[255]',
        'apellido' => 'required|string|max_length[255]',
        'correo' => 'required|valid_email',
        'telefono' => 'permit_empty|alpha_numeric_punct|max_length[20]',
        'direccion' => 'permit_empty|string|max_length[500]',
        'fecha_nacimiento' => 'required|valid_date',
        'fecha_ingreso' => 'required|valid_date',
        'cargo' => 'required|string|max_length[100]',
        'departamento' => 'required|string|max_length[100]',
        'sueldo' => 'required|decimal',
        'horas_trabajo_semana' => 'required|integer|greater_than[0]',
        'estado' => 'required|in_list[activo,inactivo,licencia,suspendido]'
    ];

    protected $validationMessages = [
        'correo' => [
            'is_unique' => 'El correo ya está registrado.'
        ],
        'horas_trabajo_semana' => [
            'greater_than' => 'Las horas de trabajo deben ser mayores que 0.'
        ],
        'estado' => [
            'in_list' => 'El estado debe ser uno válido: activo, inactivo, licencia, suspendido.'
        ]
    ];
}
