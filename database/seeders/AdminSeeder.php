<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles
        //collect(['Admin', 'Jefe', 'Supervisor', 'Aprobador', 'Usuario'])->each(function ($rol) {
        //    //Role::query()->create(['name' => $rol]);
        //    Role::create(['name' => $rol]);
        //});

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
            'username' => 'PORFEO',
            'email' => 'porfeo@minsalud.gov.co',
            'password' => bcrypt('Password@2024*'),
        ],);

        $user->offices()->attach($office->id, ['sign_mech' => 'signs/admin.png']);

        //$roleAdmin = Role::find(1);
        //$user->assignRole($roleAdmin);
    }
}
