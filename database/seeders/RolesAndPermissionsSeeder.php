<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // adminユーザーを作成
        $adminUser = new User();
        $adminUser->name = '山田太郎（管理者）';
        $adminUser->email = 'test2@example.com';
        $adminUser->password = Hash::make('password');
        $adminUser->save();

        // editorユーザーを作成
        $editorUser = new User();
        $editorUser->name = '山田花子（編集者）';
        $editorUser->email = 'test3@example.com';
        $editorUser->password = Hash::make('password');
        $editorUser->save();

        // Roleの作成
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);

        // Permissionの作成
        $permissionOfEditItems =  Permission::create(['name' => 'edit items']);
        $permissionOfDeleteItems = Permission::create(['name' => 'delete items']);

        // RoleとPermissionを関連付け
        $admin->givePermissionTo($permissionOfEditItems);
        $admin->givePermissionTo($permissionOfDeleteItems);
        $editor->givePermissionTo($permissionOfEditItems);

        // UserにRoleを割り当て
        $adminUser->assignRole('admin');
        $editorUser->assignRole('editor');
    }
}
