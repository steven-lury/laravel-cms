<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Admin';
        $admin->save();

        $editor = new Role();
        $editor->name = 'editor';
        $editor->display_name = 'Editor';
        $editor->save();

        $author = new Role();
        $author->name = 'author';
        $author->display_name = 'Author';
        $author->save();

        $user1 = User::find(1);
        $user2 = User::find(2);
        $user3 = User::find(3);

        $user1->detachRole($admin);
        $user2->detachRole($editor);
        $user3->detachRole($author);

        $user1->attachRole($admin);
        $user2->attachRole($editor);
        $user3->attachRole($author);
    }
}
