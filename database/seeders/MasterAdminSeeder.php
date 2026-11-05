<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Str;

class MasterAdminSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $companyPermissions = [
            'companies.view',
            'companies.create',
            'companies.edit',
            'companies.delete',
        ];

        $memberPermissions = [
            'members.view',
            'members.create',
            'members.edit',
            'members.delete',
        ];

        $allPermissions = array_merge($companyPermissions, $memberPermissions);

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdminRole = Role::firstOrCreate([
            'name' => 'SuperAdmin',
            'guard_name' => 'web',
        ]);

        $superAdminRole->syncPermissions($companyPermissions);

        $adminRole = Role::firstOrCreate([
            'name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $adminRole->syncPermissions($memberPermissions);

        $otherRoles = [
            'Member',
        ];

        foreach ($otherRoles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);
        }

        User::updateOrCreate(
            ['email' => 'masteradmin@example.com'],
            [
                'name' => 'Master Admin',
                'email_verified_at' => now(),
                'password' => env('APP_ENV') === 'local' ? Hash::make('password') : Hash::make(Str::random(64)),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $user = User::where('email', 'masteradmin@example.com')->firstOrFail();
        $user->assignRole($superAdminRole);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
