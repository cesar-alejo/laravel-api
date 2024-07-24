<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        collect(['Root', 'Admin', 'Jefe', 'Supervisor', 'Aprobador', 'Usuario'])->each(function ($rol) {
            Role::create(['name' => $rol]);
        });

        // Permissions
        collect(['see_all', 'see_my'])->each(function ($per) {
            Permission::create(['name' => $per]);
        });

        // Asig permissions to rol
        $roleRoot = Role::findByName('Root');
        $roleRoot->givePermissionTo('see_all');

        $sede = \App\Models\Headquarters::create([
            'name' => 'Sede principal - Calle 32',
            'type' => 'H',
            'username' => 'ADMON',
        ],);

        $unit = \App\Models\AdministrativeUnit::create([
            'code' => 1000,
            'name' => 'MINISTERIO DE SALUD Y PROTECCIÓN SOCIAL',
            'username' => 'ADMON',
        ],);

        $office = \App\Models\Office::create([
            'headquarters_id' => $sede->id,
            'administrative_units_id' => $unit->id,
            'code' => 900,
            'name' => 'DEPENDENCIA DE ADMIN',
            'username' => 'ADMON',
        ],);

        $user = \App\Models\User::create([
            'type_ident' => 'NIT',
            'ident' => '99999999',
            'name' => 'ADMINISTRADOR|SISTEMA',
            'username' => 'ADMON',
            'email' => 'admon@minsalud.gov.co',
            'password' => bcrypt('Password@2024*'),
        ],);

        $user->offices()->attach($office->id, ['sign_mech' => 'signs/admin.png']);
        $user->assignRole($roleRoot);
    }
}
