<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Empleados extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'SMALLINT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'apellido' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'telefono' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'correo' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'direccion' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'fecha_nacimiento' => [
                'type'           => 'DATE',
            ],
            'fecha_ingreso' => [
                'type'           => 'DATETIME',
            ],
            'fecha_salida' => [
                'type'           => 'DATETIME',
                'null'           => true,
            ],
            'activo' => [
                'type' => 'TINYINT',
                'default' => 1,
            ],
            // Claves foráneas
            'sucursal_id' => [
                'type'           => 'SMALLINT',
                'unsigned'       => true,
            ],
            'rol_id' => [
                'type'           => 'SMALLINT',
                'unsigned'       => true,
            ],
            'fecha_alta' => [
                'type'           => 'DATETIME',
            ],
            'fecha_modifica' => [
                'type'           => 'DATETIME',
            ],
        ]);

        // Agregar claves primarias
        $this->forge->addKey('id', true);

        // Agregar claves foráneas
        $this->forge->addForeignKey('sucursal_id', 'sucursales', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('rol_id', 'roles', 'id', 'CASCADE', 'CASCADE');

        // Crear la tabla
        $this->forge->createTable('empleados');
    }

    public function down()
    {
        // Eliminar la tabla
        $this->forge->dropTable('empleados');
    }
}
