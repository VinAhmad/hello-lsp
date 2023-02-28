<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Kategori;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Admin::create([
            'username'=>'admin_1',
            'password'=>bcrypt('admin')
        ]);
        Admin::create([
            'username'=>'admin_2',
            'password'=>bcrypt('admin')
        ]);

        Kategori::create([
            'kategori'=>'Kebersihan'
        ]);

        Kategori::create([
            'kategori'=>'Keamanan'
        ]);

        Kategori::create([
            'kategori'=>'Penugasan'
        ]);

        Siswa::factory(10)->create();
        Siswa::create([
            'nis'=>20208998,
            'nama'=>'Kevin Ahmad Fahreza',
            'kelas'=>'XII'
        ]);
    }
}
