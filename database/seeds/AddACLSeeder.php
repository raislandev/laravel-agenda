<?php

use Illuminate\Database\Seeder;

class AddACLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Roles
        $adminACL = \App\Role::firstOrCreate(['name'=>'Admin'],[
          'description'=>'Função de Administrador'
        ]);
        $userACL = \App\Role::firstOrCreate(['name'=>'User'],[
          'description'=>'Usuário comum'
        ]);

        // User com Role
        $userAdmin = \App\User::find(1);
        $userDefault = \App\User::find(2);

        $userAdmin->roles()->attach($adminACL);
        $userDefault->roles()->attach($userACL);

        // Permissions

        $viewPhone = \App\Permission::firstOrCreate(['name'=>'visualizar_telefones'],[
          'description'=>'Visualizar Telefones'
        ]);
        $editDelPhone = \App\Permission::firstOrCreate(['name'=>'edit_delete_telefone'],[
          'description'=>'editar e deletar telefones'
        ]);

        $crudUserAcl = \App\Permission::firstOrCreate(['name'=>'crud_user_acl'],[
          'description'=>'crud de usuários e acl'
        ]);


        

        // Role com Permission

        $userACL->permissions()->attach($viewPhone);
        $userACL->permissions()->attach($editDelPhone);


        echo "Registros de ACL criados! \n";
    }
}
