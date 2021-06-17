<?php


class UserMenuSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $roles = \App\Models\Role::pluck('id')->toArray();

        $menu = new \App\Models\Menu();

        /*$menuItem = 'RDKK';
        $menuData =\App\Models\Menu::create([
            'name' => $menuItem,
            'slug' => 'backend/'.\Illuminate\Support\Str::slug($menuItem),
            'icon' => 'fa-users'
        ]);
        foreach ($roles as $role) {
            $menuData->roles()->attach($role, [
                'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                'accesses' => implode(config('access.delimiter'), config('access.menu.'.$menuData->slug.'.action')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }*/

        $name = 'Laporan';
        $menus = [
            'Harian',
            'Bulanan',
        ];
        $parent = $menu->create([
            'name' => $name,
            'icon' => 'fa-folder'
        ]);
        foreach ($menus as $menuItem) {
            $menuData = $parent->children()->create([
                'name' => $menuItem,
                'slug' => 'backend/'.\Illuminate\Support\Str::slug($menuItem),
            ]);
            foreach ($roles as $role) {
                $menuData->roles()->attach($role, [
                    'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                    'accesses' => implode(config('access.delimiter'), config('access.menu.'.$menuData->slug.'.action')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $name = 'Import Data';
        $menus = [
            'Import Bulanan',
            'Import RDKK',
        ];
        $parent = $menu->create([
            'name' => $name,
            'icon' => 'fa-folder'
        ]);
        foreach ($menus as $menuItem) {
            $menuData = $parent->children()->create([
                'name' => $menuItem,
                'slug' => 'backend/'.\Illuminate\Support\Str::slug($menuItem),
            ]);
            foreach ($roles as $role) {
                $menuData->roles()->attach($role, [
                    'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                    'accesses' => implode(config('access.delimiter'), config('access.menu.'.$menuData->slug.'.action')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $name = 'Kelola Pengguna';
        $menus = [
            'User',
            'Role',
        ];
        $parent = $menu->create([
            'name' => $name,
            'icon' => 'fa-folder'
        ]);
        foreach ($menus as $menuItem) {
            $menuData = $parent->children()->create([
                'name' => $menuItem,
                'slug' => 'backend/'.\Illuminate\Support\Str::slug($menuItem),
            ]);
            foreach ($roles as $role) {
                $menuData->roles()->attach($role, [
                    'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                    'accesses' => implode(config('access.delimiter'), config('access.menu.'.$menuData->slug.'.action')),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $menuItem = 'Setting';
        $menuData =\App\Models\Menu::create([
            'name' => $menuItem,
            'slug' => 'backend/'.\Illuminate\Support\Str::slug($menuItem),
            'icon' => 'fa-wrench'
        ]);
        foreach ($roles as $role) {
            $menuData->roles()->attach($role, [
                'id' => \Webpatser\Uuid\Uuid::generate(4)->string,
                'accesses' => implode(config('access.delimiter'), config('access.menu.'.$menuData->slug.'.action')),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
