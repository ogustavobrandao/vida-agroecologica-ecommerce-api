<?php

namespace Database\Seeders;

use App\Models\Banca;
use App\Models\Contato;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contatos = Contato::factory(4)->make();
        $roles = Role::all();
        $emails = [
            'admin@admin.com',
            'presidente@presidente.com',
            'agricultor@agricultor.com',
            'consumidor@consumidor.com'
        ];

        foreach ($roles as $indice => $role) {
            $user = User::factory()->create([
                'email' => $emails[$indice],
                'cpf' => '999.999.999-9' . (9 - $indice),
            ]);

            $user->roles()->attach($role);
            $user->contato()->save($contatos[$indice]);
        }

        Banca::factory()->create();
    }
}
