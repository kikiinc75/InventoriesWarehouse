<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('level')->insert([
            [
                'id_level' => 1,
                'nama_level' => 'Admin',
            ],
            [
                'id_level' => 2,
                'nama_level' => 'Operator',
            ],
            [
                'id_level' => 3,
                'nama_level' => 'Peminjam',
            ]
        ]);
        if(DB::table('users')->get()->count() == 0){
        DB::table('users')->insert([
            'id_level' => 1,
            'email' => 'admin123@gmail.com',
            'username' => 'admin123',
            'password' => bcrypt('admin123'),
            'nama_user' => 'Wahyu Iqbal',
            'alamat' => 'Sukorejo, Ponorogo, East Java, Indonesia'
        ]);}
    }
}
