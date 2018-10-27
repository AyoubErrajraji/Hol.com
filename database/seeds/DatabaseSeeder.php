<?php

use App\User;
use App\Role;
use App\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
            // disable fk constrain check
            // \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Call the php artisan migrate:refresh
            $this->command->call('migrate:refresh');
            $this->command->warn("Data cleared, starting from blank database.");

            // enable back fk constrain check
            // \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }


        // Seed the default permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $perms) {
            Permission::firstOrCreate(['name' => $perms]);
        }

        $this->command->info('Default Permissions added.');

        // Confirm roles needed
        if ($this->command->confirm('Create Roles for user, default is admin and user? [y|N]', true)) {

            // Ask for roles from input
            $input_roles = $this->command->ask('Enter roles in comma separate format.', 'Admin,User');

            // Explode roles
            $roles_array = explode(',', $input_roles);

            // add roles
            foreach($roles_array as $role) {
                $role = Role::firstOrCreate(['name' => trim($role)]);

                if( $role->name == 'Admin' ) {
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Admin granted all the permissions');
                } else {
                    // for others by default only read access
                    $role->syncPermissions(Permission::where('name', 'LIKE', 'view_%')->get());
                }

                // create one user for each role
                $this->createUser( $role );
            }

            $this->command->info('Roles ' . $input_roles . ' added successfully');

        } else {
            Role::firstOrCreate(['name' => 'User']);
            $this->command->info('Added only default user role.');
        }

        DB::table('ad_types')->insert([
            ['name' => 'Product'],
            ['name' => 'Dienst']
        ]);
        $this->command->info('Types seeded.');

        DB::table('ad_states')->insert([
            ['name' => 'Geblokkeerd'],
            ['name' => 'Afgewezen'],
            ['name' => 'In Afwachting'],
            ['name' => 'Actief'],
            ['name' => 'Verlopen']
        ]);
        $this->command->info('Ad States seeded.');

        // now lets seed some products for demo
        factory(\App\Ad::class, 30)->create();
        $this->command->info('Some Ad data seeded.');

        // now lets seed some bids for demo
        factory(\App\Bid::class, 5)->create();
        $this->command->info('Some Bid data seeded.');

        // now lets seed some watchlistitems for demo
        factory(\App\WatchListItem::class, 5)->create();
        $this->command->info('Some WatchListItem data seeded.');

        foreach(User::get() as $user){
            factory(\App\Settings::class, 1)->create(['user_id' => $user->id]);
        }

        $this->command->warn('All done :)');
    }

    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function createUser($role)
    {
        if ($role->name == 'Admin'){
            $user = factory(User::class)->create(['name' => 'Lex de Willigen', 'email' => 'lex@agilepixels.com']);
            $extraUser = factory(User::class)->create(['name' => 'Luke Hol', 'email' => 'luke@agilepixels.com']);
            $extraUser2 = factory(User::class)->create(['name' => 'Bart de Ruiter', 'email' => 'rui@deringvanputten.nl']);
            $extraUser->assignRole($role->name);
            $extraUser2->assignRole($role->name);
        } else {
            $user = factory(User::class)->create();
        }
        $user->assignRole($role->name);

        if( $role->name == 'Admin' ) {
            $this->command->info('Here is your admin details to login:');
            $this->command->warn('Password is "secret"');
        }
    }
}
