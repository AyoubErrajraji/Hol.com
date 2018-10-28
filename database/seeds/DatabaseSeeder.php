<?php

use App\User;
use App\Role;
use App\Permission;
use App\Settings;
use App\User_has_Address;
use App\Product;
use App\Product_Category;
use App\WishList;
use App\WishListItem;
use App\Cart;
use App\CartItem;
use App\Order;
use App\Address;
use App\OrderState;
use App\Payment;
use App\PaymentType;
use App\Order_has_Products;
use App\Review;
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
                $this->createUser($role);
            }

            $this->command->info('Roles ' . $input_roles . ' added successfully');

        } else {
            Role::firstOrCreate(['name' => 'User']);
            $this->command->info('Added only default user role.');
        }

        //Insert settings
        foreach(User::get() as $index => $user){
            factory(Settings::class, 1)->create(['user_id' => $user->id]);
            factory(Address::class, 1)->create();
            factory(App\User_has_Address::class)->create(['user_id' => $user->id, 'address_id' => $user->id]);
        }

        //Insert Products
        factory(Product::class, 30)->create();
        $this->command->info('Some Product data seeded.');

        //Insert Categories
        DB::table('categories')->insert([
            ['name' => 'Category 1'],
            ['name' => 'Category 2'],
            ['name' => 'Category 3'],
            ['name' => 'Category 4']
        ]);
        $this->command->info('Categories seeded.');

        //Insert Product_Categories
        factory(Product_Category::class, 30)->create();
        $this->command->info('Product_Categories seeded.');


        //Insert Wishlists
        factory(WishList::class, 10)->create();
        foreach (WishList::get() as $wishlist) {
            factory(WishListItem::class, 3)->create(['wishlist_id' => $wishlist->id]);
        }
        $this->command->info('Some Wishlist data seeded.');

        //Insert Carts
        factory(Cart::class, 10)->create();
        foreach (Cart::get() as $cart) {
            factory(CartItem::class, 3)->create(['cart_id' => $cart->id]);
        }
        $this->command->info('Some Cart data seeded.');

        //Insert Order States
        DB::table('order_states')->insert([
            ['name' => 'Order Geplaatst'],
            ['name' => 'Betaling Ontvangen'],
            ['name' => 'Bij de Bezorgdienst'],
            ['name' => 'Ontvangen']
        ]);

        //Insert Payment Types
        DB::table('payment_types')->insert([
            ['name' => 'iDeal'],
            ['name' => 'Afterpay'],
            ['name' => 'Creditcard'],
            ['name' => 'Airmiles']
        ]);

        //Insert Orders
        factory(Order::class, 20)->create();

        //Insert Payments and Order Product
        foreach (Order::get() as $order) {
            factory(Payment::class, 1)->create(['order_id' => $order->id]);
            factory(Order_has_Products::class, 1)->create(['order_id' => $order->id]);
        }
        $this->command->info('Some Orders with payment seeded.');

        //Insert Reviews
        factory(Review::class, 20)->create();

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
            factory(User::class)->create(['name' => 'Lex de Willigen', 'email' => 'lex@agilepixels.com'])->assignRole($role->name);
            factory(User::class)->create(['name' => 'Ayoub Errajraji', 'email' => 'aerrajraji@hotmail.com'])->assignRole($role->name);
            factory(User::class)->create(['name' => 'Dennis Bergwerff', 'email' => '0945944@hr.nl'])->assignRole($role->name);
            factory(User::class)->create(['name' => 'Eva Wegman', 'email' => '0946319@hr.nl'])->assignRole($role->name);
            factory(User::class)->create(['name' => 'Lars Noordijk', 'email' => 'larsnoordijk@gmail.com'])->assignRole($role->name);
        } else {
            factory(User::class)->create()->assignRole($role->name);
        }
    }
}
