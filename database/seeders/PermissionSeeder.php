<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // voters
        Permission::create(['name' => 'create voters']);
        Permission::create(['name' => 'read voters']);
        Permission::create(['name' => 'update voters']);
        Permission::create(['name' => 'delete voters']);
        Permission::create(['name' => 'delete-permanently voters']);
        Permission::create(['name' => 'search voters']);
        Permission::create(['name' => 'trash voters']);
        Permission::create(['name' => 'restore voters']);
        Permission::create(['name' => 'import voters']);
        Permission::create(['name' => 'export voters']);
        Permission::create(['name' => 'read-online-voters voters']);
        Permission::create(['name' => 'read-offline-voters voters']);

        // positions
        Permission::create(['name' => 'create positions']);
        Permission::create(['name' => 'read positions']);
        Permission::create(['name' => 'update positions']);
        Permission::create(['name' => 'delete positions']);

        // candidates
        Permission::create(['name' => 'create candidates']);
        Permission::create(['name' => 'read candidates']);
        Permission::create(['name' => 'update candidates']);
        Permission::create(['name' => 'delete candidates']);
        Permission::create(['name' => 'export candidates']);

        // counters
        Permission::create(['name' => 'create counters']);
        Permission::create(['name' => 'read counters']);
        Permission::create(['name' => 'update counters']);
        Permission::create(['name' => 'delete counters']);

        // counter-officers
        Permission::create(['name' => 'create counter-officers']);
        Permission::create(['name' => 'read counter-officers']);
        Permission::create(['name' => 'update counter-officers']);
        Permission::create(['name' => 'delete counter-officers']);

        // ballots
        Permission::create(['name' => 'create ballots']);
        Permission::create(['name' => 'read ballots']);
        Permission::create(['name' => 'update ballots']);
        Permission::create(['name' => 'delete ballots']);

        // activity-logs
        Permission::create(['name' => 'read activity-logs']);
        Permission::create(['name' => 'search activity-logs']);
        Permission::create(['name' => 'read email-logs']);
        Permission::create(['name' => 'search email-logs']);

        // email-templates
        Permission::create(['name' => 'create email-templates']);
        Permission::create(['name' => 'read email-templates']);
        Permission::create(['name' => 'update email-templates']);
        Permission::create(['name' => 'delete email-templates']);
        Permission::create(['name' => 'send email-templates']);

        // roles
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);
        Permission::create(['name' => 'assign-permissions roles']);

        // permissions
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'read permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        // tokens
        Permission::create(['name' => 'read tokens']);
        Permission::create(['name' => 'generate tokens']);
        Permission::create(['name' => 'lock tokens']);

        // users
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'trash users']);
        Permission::create(['name' => 'restore users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'update-profile users']);

        // qr_codes
        Permission::create(['name' => 'read qr-codes']);
        Permission::create(['name' => 'generate qr-codes']);
        Permission::create(['name' => 'export qr-codes']);
        Permission::create(['name' => 'lock qr-codes']);
        Permission::create(['name' => 'validate-ballots qr-codes']);
        Permission::create(['name' => 'verify-ballots qr-codes']);

        // offline-tokens
        Permission::create(['name' => 'create offline-tokens']);
        Permission::create(['name' => 'read offline-tokens']);
        Permission::create(['name' => 'search offline-tokens']);
        Permission::create(['name' => 're-print offline-tokens']);

        // settings
        Permission::create(['name' => 'read settings']);
        Permission::create(['name' => 'update settings']);
        Permission::create(['name' => 'update-actions settings']);
        Permission::create(['name' => 'update-print-config settings']);
        Permission::create(['name' => 'update-voting-schedule settings']);
        Permission::create(['name' => 'update-email-config settings']);
        Permission::create(['name' => 'update-sms-config settings']);
        Permission::create(['name' => 'test-devices-services settings']);
        Permission::create(['name' => 'db-clean settings']);

        // applications
        Permission::create(['name' => 'create-form applications']);
        Permission::create(['name' => 'read-submissions applications']);
        Permission::create(['name' => 'export-submissions applications']);
        Permission::create(['name' => 'approve-submissions applications']);
        Permission::create(['name' => 'decline-submissions applications']);

        // voting-results
        Permission::create(['name' => 'read voting-results']);
        Permission::create(['name' => 'upload-voting-results voting-results']);
    }
}
