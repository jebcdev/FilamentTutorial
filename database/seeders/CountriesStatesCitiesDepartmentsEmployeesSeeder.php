<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class CountriesStatesCitiesDepartmentsEmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear el país Colombia
        $colombia = Country::create([
            'name' => 'Colombia',
        ]);

        // 2. Crear el estado Antioquia
        $antioquia = State::create([
            'name' => 'Antioquia',
            'country_id' => $colombia->id,
        ]);

        // Crear el estado Amazonas
        $amazonas = State::create([
            'name' => 'Amazonas',
            'country_id' => $colombia->id,
        ]);

        // Crear el estado Magdalena
        $magdalena = State::create([
            'name' => 'Magdalena',
            'country_id' => $colombia->id,
        ]);

        // 3. Crear ciudades en Antioquia
        $antioquiaCities = [
            'Medellín',
            'Bello',
            'Itagüí',
            'Envigado',
            'Rionegro',
        ];

        foreach ($antioquiaCities as $cityName) {
            City::create([
                'name' => $cityName,
                'state_id' => $antioquia->id,
            ]);
        }

        // Crear ciudades en Amazonas
        $amazonasCities = [
            'Leticia',
            'Puerto Nariño',
        ];

        foreach ($amazonasCities as $cityName) {
            City::create([
                'name' => $cityName,
                'state_id' => $amazonas->id,
            ]);
        }

        // Crear ciudades en Magdalena
        $magdalenaCities = [
            'Santa Marta',
            'Ciénaga',
            'Fundación',
        ];

        foreach ($magdalenaCities as $cityName) {
            City::create([
                'name' => $cityName,
                'state_id' => $magdalena->id,
            ]);
        }

        // 4. Crear departamentos
        $departments = [
            'Recursos Humanos',
            'Contabilidad',
            'Desarrollo',
            'Marketing',
            'Ventas',
        ];

        foreach ($departments as $departmentName) {
            Department::create([
                'name' => $departmentName,
            ]);
        }

        // 5. Crear empleados
        $employees = [
            [
                'first_name' => 'Juan',
                'last_name' => 'Pérez',
                'address' => 'Calle 123 #45-67',
                'zip_code' => '050001',
                'date_of_birth' => '1990-05-15',
                'date_hired' => '2020-01-15',
                'city_id' => City::where('name', 'Medellín')->first()->id,
                'department_id' => Department::where('name', 'Desarrollo')->first()->id,
            ],
            [
                'first_name' => 'María',
                'last_name' => 'Gómez',
                'address' => 'Carrera 50 #34-45',
                'zip_code' => '050002',
                'date_of_birth' => '1985-08-22',
                'date_hired' => '2018-03-25',
                'city_id' => City::where('name', 'Envigado')->first()->id,
                'department_id' => Department::where('name', 'Marketing')->first()->id,
            ],
            [
                'first_name' => 'Carlos',
                'last_name' => 'Martínez',
                'address' => 'Avenida 12 #9-45',
                'zip_code' => '910001',
                'date_of_birth' => '1995-06-10',
                'date_hired' => '2019-07-01',
                'city_id' => City::where('name', 'Leticia')->first()->id,
                'department_id' => Department::where('name', 'Ventas')->first()->id,
            ],
            [
                'first_name' => 'Luisa',
                'last_name' => 'Ramírez',
                'address' => 'Carrera 8 #23-56',
                'zip_code' => '470001',
                'date_of_birth' => '1992-11-12',
                'date_hired' => '2021-04-10',
                'city_id' => City::where('name', 'Santa Marta')->first()->id,
                'department_id' => Department::where('name', 'Recursos Humanos')->first()->id,
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create(array_merge($employee, [
                'country_id' => $colombia->id,
                'state_id' => City::find($employee['city_id'])->state_id,
            ]));
        }
    }
}
