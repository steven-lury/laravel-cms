<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Permission;
use App\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();
        $curd_post = new Permission();
        $curd_post->name = 'crud-post';
        $curd_post->save();

        $update_others_post = new Permission();
        $update_others_post->name = 'update-others-post';
        $update_others_post->save();

        $delete_others_post = new Permission();
        $delete_others_post->name = 'delete-others-permission';
        $delete_others_post->save();

        $curd_category = new Permission();
        $curd_category->name = 'crud-category';
        $curd_category->save();

        $crud_user = new Permission();
        $crud_user->name = 'crud-user';
        $crud_user->save();

        $admin = Role::whereName('admin')->first();
        $editor = Role::whereName('editor')->first();
        $author = Role::whereName('author')->first();

        $admin->detachPermissions([
            $curd_post, $update_others_post, $delete_others_post, $curd_category, $crud_user
        ]);
        $editor->detachPermissions([
            $curd_post, $update_others_post, $delete_others_post, $curd_category
        ]);

        $author->detachPermission($curd_post);

        $admin->attachPermissions([
            $curd_post, $update_others_post, $delete_others_post, $curd_category, $crud_user
        ]);
        $editor->attachPermissions([
            $curd_post, $update_others_post, $delete_others_post, $curd_category
        ]);

        $author->attachPermission($curd_post);

    }
}
