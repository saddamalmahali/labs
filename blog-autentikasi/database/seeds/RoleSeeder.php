<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = json_encode([
            'create-post'=>true,
        ]);
        $author = Role::create([
            'name'=> 'Author',
            'slug'=> 'author',
            'permissions'=> $permission
        ]);
        $permission2 = json_encode([
                'update-post'=>true,
                'publish-post'=>true,
            ]);
        $editor = Role::create([
            'name'=> 'Editor',
            'slug'=> 'editor',
            'permissions'=> $permission2
        ]);
    }
}
