<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\EmployeeInfo;
use Spatie\Permission\Models\Role;
use DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SuperAdmin = User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('111'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $Admin = User::create([
            'name' => 'Myat',
            'username' => 'Myat',
            'email' => 'Myat@gmail.com',
            'password' => Hash::make('111'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $AssistantManager = User::create([
            'name' => 'kaung',
            'username' => 'kaung',
            'email' => 'kaung@gmail.com',
            'password' => Hash::make('111'),
            'role' => 'employee',
            'status' => 'active',
        ]);

        $AssistantManager->employeeInfo()->create([
            'address' => 'Sample Address 1',

        ]);

        $SeniorSaleAssistant = User::create([
            'name' => 'Zaw',
            'username' => 'zaw',
            'email' => 'zaw@gmail.com',
            'password' => Hash::make('111'),
            'role' => 'employee',
            'status' => 'active',
        ]);

        $SeniorSaleAssistant->employeeInfo()->create([
            'address' => 'Sample Address 2',

        ]);

        $user = User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('111'),
            'role' => 'user',
            'status' => 'active',
        ]);

        $assistantManager = User::where('username', 'kaung')->first();
        if ($assistantManager) {
            $assistantManager->salary()->create([
                'basic_salary' => 5000,
                'time_bonus' => 200,
                'day_bonus' => 150,
                'yearly_bonus' => 1000,
                'company_bonus' => 300,
                'movie_bonus' => 250,
                'daily_movie_bonus' => 50,
                'pocket_money' => 100,
                'extra_money' => 150,
            ]);
        }

        $seniorSaleAssistant = User::where('username', 'zaw')->first();
        if ($seniorSaleAssistant) {
            $seniorSaleAssistant->salary()->create([
                'basic_salary' => 4500,
                'time_bonus' => 150,
                'day_bonus' => 100,
                'yearly_bonus' => 800,
                'company_bonus' => 250,
                'movie_bonus' => 200,
                'daily_movie_bonus' => 40,
                'pocket_money' => 80,
                'extra_money' => 120,
            ]);
        }

        if (!Role::where('name', 'SuperAdmin')->exists()) {
            $superAdminRole = Role::create(['name' => 'SuperAdmin']);
            $AdminRole = Role::create(['name' => 'Admin']);
            $AssistantManagerRole = Role::create(['name' => 'Assistant Manager']);
            $SeniorSaleAssistantRole = Role::create(['name' => 'Senior Sale Assistant']);
        } else {
            $superAdminRole = Role::where('name', 'SuperAdmin')->first();
        }

        if ($superAdminRole) {
            $SuperAdmin->assignRole($superAdminRole);
        }

        if ($AdminRole) {
            $Admin->assignRole($AdminRole);
        }

        if ($AssistantManagerRole) {
            $AssistantManager->assignRole($AssistantManagerRole);
        }

        if ($SeniorSaleAssistantRole) {
            $SeniorSaleAssistant->assignRole($SeniorSaleAssistantRole);
        }


    }
}
