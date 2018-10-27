<?php

namespace App;

class Permission extends \Spatie\Permission\Models\Permission
{

    public static function defaultPermissions()
    {
        return [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',

            'view_ads',
            'add_ads',
            'edit_ads',
            'delete_ads',

            'view_approves',
            'manage_pending',
            'block_ad',
            'unblock_ad',
        ];
    }
}
