<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserTableSeeder');
        $this->command->info('User table seeded!');
        $this->call('PrefsSeeder');
        $this->command->info('Prefs table seeded!');

    }
}//end database seeder

class UserTableSeeder extends Seeder {

    public function run()
    {
//        DB::table('users')->delete();
        App\Models\UserModel::create(['name' => 'admin',
                                     'password'=>Hash::make('admin'),
                                     //'role'=>'1',
                                      'active'=>'1',
                                      'img'=>\App\Models\UserModel::MALE_LOGO
        ]);
    }


}//end User Table seeder


class PrefsSeeder extends Seeder {

    public function run()
    {

        App\Models\PrefsModel::create(['title' => 'الروماني جروب للسيراميك والبورسلين',
            'slogan'=>'', 'user_id'=>'1',
        ]);
    }


}//end Prefs Table seeder
