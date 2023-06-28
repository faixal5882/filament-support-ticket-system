<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_permissions = Permission::all();

        $agent_permissions = Permission::whereIn('title', [
            'ticket_show',
            'ticket_access',
            'ticket_create',
            'ticket_edit',
            'client_create',
            'client_edit',
            'client_access',
        ])->get();

        Role::findOrFail(1)->permissions()->sync($admin_permissions);
        Role::findOrFail(2)->permissions()->sync($agent_permissions);
    }
}
