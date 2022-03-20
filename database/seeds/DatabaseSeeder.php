<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('superadmin'),
            'roles' => 'super'
        ]);

        //distributor
        DB::table('distributors')->insert([
            'ds_nama' => 'distributor1',
            'ds_gambar' => 'warehouse.png',
            'ds_kode' => 'dis1',
            'ds_alamat' => 'alamat distributor1',
            'ds_pemilik' => 'pemilik distributor1',
            'ds_deskripsi' => 'deskripsi distributor1',
            'ds_telp' => '123123123123',
            'ds_email' => 'dis1@distributor.com',
            'ds_active' => 'aktif',
        ]);

        DB::table('users')->insert([
            'username' => 'distributor1',
            'email' => 'dis1@distributor.com',
            'password' => Hash::make('distributor'),
            'roles' => 'distributor',
            'userable_type' => 'App\Distributor',
            'userable_id' => 1
        ]);

        DB::table('distributors')->insert([
            'ds_nama' => 'distributor2',
            'ds_gambar' => 'warehouse.png',
            'ds_kode' => 'dis2',
            'ds_alamat' => 'alamat distributor2',
            'ds_pemilik' => 'pemilik distributor2',
            'ds_deskripsi' => 'deskripsi distributor2',
            'ds_telp' => '123123123123',
            'ds_email' => 'dis2@distributor.com',
            'ds_active' => 'aktif',
        ]);

        DB::table('users')->insert([
            'username' => 'distributor2',
            'email' => 'dis2@distributor.com',
            'password' => Hash::make('distributor'),
            'roles' => 'distributor',
            'userable_type' => 'App\Distributor',
            'userable_id' => 2
        ]);

        DB::table('distributors')->insert([
            'ds_nama' => 'distributortolak',
            'ds_gambar' => 'warehouse.png',
            'ds_kode' => 'dis3',
            'ds_alamat' => 'alamat distributortolak',
            'ds_pemilik' => 'pemilik distributortolak',
            'ds_deskripsi' => 'deskripsi distributortolak',
            'ds_telp' => '123123123123',
            'ds_email' => 'distolak@distributor.com',
            'ds_active' => 'tolak',
            'alasan_tolak' => "test"
        ]);

        DB::table('users')->insert([
            'username' => 'distributortolak',
            'email' => 'distolak@distributor.com',
            'password' => Hash::make('distributor'),
            'roles' => 'distributor',
            'userable_type' => 'App\Distributor',
            'userable_id' => 3
        ]);

        DB::table('distributors')->insert([
            'ds_nama' => 'distributornon',
            'ds_gambar' => 'warehouse.png',
            'ds_kode' => 'dis4',
            'ds_alamat' => 'alamat distributornon',
            'ds_pemilik' => 'pemilik distributornon',
            'ds_deskripsi' => 'deskripsi distributornon',
            'ds_telp' => '123123123123',
            'ds_email' => 'disnon@distributor.com',
            'ds_active' => 'non-aktif',
        ]);

        DB::table('users')->insert([
            'username' => 'distributornon',
            'email' => 'disnon@distributor.com',
            'password' => Hash::make('distributor'),
            'roles' => 'distributor',
            'userable_type' => 'App\Distributor',
            'userable_id' => 4
        ]);

        DB::table('distributors')->insert([
            'ds_nama' => 'distributortest',
            'ds_gambar' => 'warehouse.png',
            'ds_kode' => 'dis5',
            'ds_alamat' => 'alamat distributortest',
            'ds_pemilik' => 'pemilik distributortest',
            'ds_deskripsi' => 'deskripsi distributortest',
            'ds_telp' => '123123123123',
            'ds_email' => 'distest@distributor.com',
            'ds_active' => 'aktif',
        ]);

        DB::table('users')->insert([
            'username' => 'distributortest',
            'email' => 'distest@distributor.com',
            'password' => Hash::make('distributor'),
            'roles' => 'distributor',
            'userable_type' => 'App\Distributor',
            'userable_id' => 5
        ]);

        //toko
        DB::table('tokos')->insert([
            'tk_nama' => 'toko1',
            'tk_gambar' => 'store.jpg',
            'tk_alamat' => 'alamat toko1',
            'tk_pemilik' => 'pemilik toko1',
            'tk_telp' => '123123123123',
            'tk_email' => 'toko1@toko.com',
            'tk_active' => 'aktif',
        ]);

        DB::table('users')->insert([
            'username' => 'toko1',
            'email' => 'toko1@toko.com',
            'password' => Hash::make('tokotoko'),
            'roles' => 'toko',
            'userable_type' => 'App\Toko',
            'userable_id' => 1
        ]);

        DB::table('tokos')->insert([
            'tk_nama' => 'toko2',
            'tk_gambar' => 'store.jpg',
            'tk_alamat' => 'alamat toko2',
            'tk_pemilik' => 'pemilik toko2',
            'tk_telp' => '123123123123',
            'tk_email' => 'toko2@toko.com',
            'tk_active' => 'aktif',
        ]);

        DB::table('users')->insert([
            'username' => 'toko2',
            'email' => 'toko2@toko.com',
            'password' => Hash::make('tokotoko'),
            'roles' => 'toko',
            'userable_type' => 'App\Toko',
            'userable_id' => 2
        ]);

        DB::table('tokos')->insert([
            'tk_nama' => 'tokotolak',
            'tk_gambar' => 'store.jpg',
            'tk_alamat' => 'alamat tokotolak',
            'tk_pemilik' => 'pemilik tokotolak',
            'tk_telp' => '123123123123',
            'tk_email' => 'tokotolak@toko.com',
            'tk_active' => 'tolak',
            'alasan_tolak' => "test"
        ]);

        DB::table('users')->insert([
            'username' => 'tokotolak',
            'email' => 'tokotolak@toko.com',
            'password' => Hash::make('tokotoko'),
            'roles' => 'toko',
            'userable_type' => 'App\Toko',
            'userable_id' => 3
        ]);

        DB::table('tokos')->insert([
            'tk_nama' => 'tokonon',
            'tk_gambar' => 'store.jpg',
            'tk_alamat' => 'alamat tokonon',
            'tk_pemilik' => 'pemilik tokonon',
            'tk_telp' => '123123123123',
            'tk_email' => 'tokonon@toko.com',
            'tk_active' => 'non-aktif',
        ]);

        DB::table('users')->insert([
            'username' => 'tokonon',
            'email' => 'tokonon@toko.com',
            'password' => Hash::make('tokotoko'),
            'roles' => 'toko',
            'userable_type' => 'App\Toko',
            'userable_id' => 4
        ]);

        //sales
        DB::table('saless')->insert([
            'sl_nama' => 'sales1',
            'sl_gambar' => 'profil.jpg',
            'sl_kode' => 'sales1',
            'sl_alamat' => 'alamat sales1',
            'sl_telp' => '123123123123',
            'sl_email' => 'sales1@sales.com',
            'distributor_id' => 1
        ]);

        DB::table('users')->insert([
            'username' => 'sales1',
            'email' => 'sales1@sales.com',
            'password' => Hash::make('salessales'),
            'roles' => 'sales',
            'userable_type' => 'App\Sales',
            'userable_id' => 1
        ]);

        DB::table('saless')->insert([
            'sl_nama' => 'sales2',
            'sl_gambar' => 'profil2.png',
            'sl_kode' => 'sales2',
            'sl_alamat' => 'alamat sales2',
            'sl_telp' => '123123123123',
            'sl_email' => 'sales2@sales.com',
            'distributor_id' => 1
        ]);

        DB::table('users')->insert([
            'username' => 'sales2',
            'email' => 'sales2@sales.com',
            'password' => Hash::make('salessales'),
            'roles' => 'sales',
            'userable_type' => 'App\Sales',
            'userable_id' => 2
        ]);

        DB::table('saless')->insert([
            'sl_nama' => 'sales3',
            'sl_gambar' => 'profil2.png',
            'sl_kode' => 'sales3',
            'sl_alamat' => 'alamat sales3',
            'sl_telp' => '123123123123',
            'sl_email' => 'sales3@sales.com',
            'distributor_id' => 2
        ]);

        DB::table('users')->insert([
            'username' => 'sales3',
            'email' => 'sales3@sales.com',
            'password' => Hash::make('salessales'),
            'roles' => 'sales',
            'userable_type' => 'App\Sales',
            'userable_id' => 3
        ]);

        DB::table('satuans')->insert([
            'st_nama' => 'box',
            'distributor_id' => 1
        ]);

        DB::table('satuans')->insert([
            'st_nama' => 'pieces',
            'distributor_id' => 1
        ]);

        DB::table('satuans')->insert([
            'st_nama' => 'pack',
            'distributor_id' => 2
        ]);

        DB::table('satuans')->insert([
            'st_nama' => 'pcs',
            'distributor_id' => 2
        ]);

        DB::table('produks')->insert([
            'pd_nama' => 'Bumbu Dapur',
            'pd_kode' => 'P-0101',
            'pd_deskripsi' => 'bumbu untuk masak Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'pd_stok' => '123',
            'distributor_id' => 1
        ]);

        DB::table('hargas')->insert([
            'produk_id' => 1,
            'satuan_id' => 1,
            'hg_qty' => 1,
            'hg_nominal' => 10000
        ]);

        DB::table('hargas')->insert([
            'produk_id' => 1,
            'satuan_id' => 1,
            'hg_qty' => 100,
            'hg_nominal' => 8000
        ]);

        DB::table('produks')->insert([
            'pd_nama' => 'Sabun Mandi',
            'pd_kode' => 'P-0102',
            'pd_deskripsi' => 'sabun untuk mandi Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'pd_stok' => '123',
            'distributor_id' => 1
        ]);
        
        DB::table('hargas')->insert([
            'produk_id' => 2,
            'satuan_id' => 2,
            'hg_qty' => 1,
            'hg_nominal' => 20000
        ]);
        
        DB::table('hargas')->insert([
            'produk_id' => 2,
            'satuan_id' => 2,
            'hg_qty' => 500,
            'hg_nominal' => 15000
        ]);

        DB::table('produks')->insert([
            'pd_nama' => 'Minuman Segar',
            'pd_kode' => 'P-0201',
            'pd_deskripsi' => 'minuman segar Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'pd_stok' => '123',
            'distributor_id' => 2
        ]);
        
        DB::table('hargas')->insert([
            'produk_id' => 3,
            'satuan_id' => 3,
            'hg_qty' => 1,
            'hg_nominal' => 50000
        ]);
        
        DB::table('hargas')->insert([
            'produk_id' => 3,
            'satuan_id' => 3,
            'hg_qty' => 100,
            'hg_nominal' => 40000
        ]);
        
        DB::table('hargas')->insert([
            'produk_id' => 3,
            'satuan_id' => 3,
            'hg_qty' => 1000,
            'hg_nominal' => 30000
        ]);

        DB::table('produks')->insert([
            'pd_nama' => 'Ciki ciki',
            'pd_kode' => 'P-0202',
            'pd_deskripsi' => 'ciki ciki Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'pd_stok' => '123',
            'distributor_id' => 2
        ]);
        
        DB::table('hargas')->insert([
            'produk_id' => 4,
            'satuan_id' => 4,
            'hg_qty' => 100,
            'hg_nominal' => 5000
        ]);
        
        DB::table('hargas')->insert([
            'produk_id' => 4,
            'satuan_id' => 4,
            'hg_qty' => 1000,
            'hg_nominal' => 3500
        ]);
    }
}
