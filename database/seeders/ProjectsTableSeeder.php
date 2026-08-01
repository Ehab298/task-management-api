<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projects')->delete();
        
        \DB::table('projects')->insert(array (
            0 => 
            array (
                'id' => 13,
                'user_id' => 15,
                'name' => 'IT system',
                'description' => NULL,
                'status' => 'active',
                'created_at' => '2026-08-01 11:44:15',
                'updated_at' => '2026-08-01 11:44:15',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 14,
                'user_id' => 16,
                'name' => 'Lorem Ipsum',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since 1966, when designers at Letraset and James Mosley, the librarian at St Bride Printing Library in London, took a 1914 Cicero translation and scrambled it to make dummy text for Letraset\'s Body Type sheets. It has survived not only many decades, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised thanks to these sheets and more recently with desktop publishing software like Aldus PageMaker and Microsoft Word including versions of Lorem Ipsum.',
                'status' => 'archived',
                'created_at' => '2026-08-01 21:40:44',
                'updated_at' => '2026-08-01 21:47:54',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}