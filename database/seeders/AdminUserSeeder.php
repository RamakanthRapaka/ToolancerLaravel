<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * -------------------------------------------------
         * Create Admin Role (if not exists)
         * -------------------------------------------------
         */
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            ['guard_name' => 'web']
        );

        /**
         * -------------------------------------------------
         * Create Admin User (if not exists)
         * -------------------------------------------------
         */
        $admin = User::firstOrCreate(
            ['email' => 'admin@toolancer.com'],
            [
                'name'         => 'Admin',
                'display_name' => 'Super Admin',
                'mobile'       => '9999999999',
                'password'     => Hash::make('Admin@123'),
            ]
        );

        /**
         * -------------------------------------------------
         * Assign Admin Role
         * -------------------------------------------------
         */
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($adminRole);
        }

        $this->command->info('✅ Admin user seeded successfully');
    }
}
