<?php

namespace Database\Seeders;


use App\PermissionsEnum;
use App\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $userRole = Role::create(['name' => RolesEnum::User->value]);
        $vendorRole = Role::create(['name' => RolesEnum::Vendor->value]);
        $adminRole = Role::create(['name' => RolesEnum::Admin->value]);

        // Create permissions
        $approveVendors = Permission::create(['name' => PermissionsEnum::ApproveVendors->value]);
        $sellProducts = Permission::create(['name' => PermissionsEnum::SellProducts->value]);
        $buyProducts = Permission::create(['name' => PermissionsEnum::BuyProducts->value]);

        // Assign permissions to roles
        $userRole->syncPermissions([$buyProducts]);
        $vendorRole->syncPermissions([$buyProducts, $sellProducts]);
        $adminRole->syncPermissions([$buyProducts, $sellProducts, $approveVendors]);
    }
}
