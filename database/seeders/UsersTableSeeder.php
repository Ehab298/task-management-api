<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 15,
                'name' => 'ehab',
                'email' => 'ehabmohammed@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$wgHD9N47KF54nKy5W4Ro1eSZgovCSfenxybzST4kJAqRQG7GAMk3S',
                'remember_token' => NULL,
                'created_at' => '2026-08-01 11:33:05',
                'updated_at' => '2026-08-01 11:33:05',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 16,
                'name' => 'ail',
                'email' => 'ailmohammed@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$wOYKe4aZJfZ/.c.gkGBxw.28VCh2C/fmGon7UKg2kDsG5494siARK',
                'remember_token' => NULL,
                'created_at' => '2026-08-01 21:30:36',
                'updated_at' => '2026-08-01 21:30:36',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 17,
                'name' => 'Swagger Test',
                'email' => 'swag3@test.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$g1Oe/06yH0cZAdQvBj846uPq/3Q9ZeRwAPA.vVULlxvRUDuKFBcPG',
                'remember_token' => NULL,
                'created_at' => '2026-08-01 21:56:11',
                'updated_at' => '2026-08-01 21:56:11',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 18,
                'name' => 'Final Check',
                'email' => 'final@test.com',
                'email_verified_at' => NULL,
                'password' => '$2y$12$g0xU4p9EfGZaPuSEvXuzeum82Ik4DjXtWSCiB4wgledwOik5R5cGq',
                'remember_token' => NULL,
                'created_at' => '2026-08-01 22:03:56',
                'updated_at' => '2026-08-01 22:03:56',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}