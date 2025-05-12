<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SucursalSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'numero' => '666-1940-0911',
            'nombre' => 'DevSync',
            'correo' => 'papunico@gmail.com',
            'telefono' => '62650020',
            'direccion' => 'Cbba-Cochabamba',
            'mensaje' => 'Gracias por la compra',
            'folio_venta' => '0000000001',
            'activo' => 1
        ];

        $this->db->table('sucursal')->insert($data);
    }
}

