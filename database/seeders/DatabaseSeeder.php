<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        // $lastUser = User::find()->first();

        DB::table('units')->insert([
            'name' => 100,
            'id_owner' => 1,
            'id_users_live' => 0
        ]);
        
        DB::table('units')->insert([
            'name' => 101,
            'id_owner' => 1,
            'id_users_live' => 0
        ]);

        DB::table('units')->insert([
            'name' => 200,
            'id_owner' => 0,
            'id_users_live' => 0
        ]);

        DB::table('units')->insert([
            'name' => 201,
            'id_owner' => 0,
            'id_users_live' => 0
        ]);

        DB::table('areas')->insert([
            'allowed' => '1',
            'title' => 'Academia',
            'cover'=>'gym.jpg',
            'days' => '1,2,4,5',
            'start_time' => '06:00:00',
            'end_time' => '22:00:00',
        ]);

        DB::table('areas')->insert([
            'allowed' => '1',
            'title' => 'Piscina',
            'cover'=>'pool.jpg',
            'days' => '1,2,3,4,5',
            'start_time' => '07:00:00',
            'end_time' => '23:00:00',
        ]);

        DB::table('areas')->insert([
            'allowed' => '1',
            'title' => 'Churrasqueira',
            'cover'=>'barbecue.jpg',
            'days' => '4,5,6',
            'start_time' => '09:00:00',
            'end_time' => '23:00:00',
        ]);

        DB::table('walls')->insert([
            'title' => 'Titulo de aviso teste',
            'datetimecreated' => '2020-12-20 15:00:00',
            'body' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            'id_users' => 1

        ]);

        DB::table('walls')->insert([
            'title' => 'Alerta geral',
            'datetimecreated' => '2020-12-20 15:00:00',
            'body' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry.",
            'id_users' => 1
            
        ]);

        
    }

    // public function addUnits($n){

    //     $apt = 000;
    //     foreach ($n as $key) {

    //         DB::table('units')->insert([
    //             'name' => 'APT 100',
    //             'id_owner' => 1
    //         ]);
    //     }
        
            
    // }
}
