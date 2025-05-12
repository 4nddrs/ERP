<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table      = 'usuarios';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['usuario', 'password', 'nombre', 'activo', 'id_sucursal', 'id_rol'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_modifica';

    public function validaUsuario($usuario, $password)
    {
        $this->select('*');
        $this->join('roles', 'roles.id = usuarios.id_rol', 'inner'); // Reemplaza 'id' y 'rol_id' con los nombres reales de las columnas
        $this->where(['usuarios.usuario' => $usuario, 'usuarios.activo' => 1]);

        $usuarioData = $this->get()->getRowArray();

        if ($usuarioData && password_verify($password, $usuarioData['password'])) {
            return $usuarioData;
        }

        return null;
    }
}
