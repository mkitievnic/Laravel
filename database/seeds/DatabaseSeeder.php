<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SeccionSeeder::class);
        $this->call(FuncionSeeder::class);
        $this->call(CursoSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(EmpleadoSeeder::class);
        $this->call(UserSeeder::class);
//        $this->call(InstructorSeedeer::class);
    }
}
