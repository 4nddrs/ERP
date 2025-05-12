<?php

namespace App\Database\Seeds;

use App\Models\RolesModel;
use App\Models\SucursalModel;
use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        //RECUPERAR SUCURSAL
        $ModelSucursal = new SucursalModel();
        $ModelRol = new RolesModel();
        $sucursal = $ModelSucursal->first();
        $rol = $ModelRol->first();

        $data = [
            'usuario'  => 'admin',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'nombre'   => 'Administrador',
            'activo'   => 1,
            'id_sucursal' => $sucursal['id'],
            'id_rol' => $rol['id']
        ];

        // Using Query Builder
        $this->db->query('INSERT INTO usuarios (usuario, password, nombre, activo, id_sucursal, id_rol) VALUES(:usuario:, :password:, :nombre:, :activo:, :id_sucursal:, :id_rol:)', $data);
    }
}
