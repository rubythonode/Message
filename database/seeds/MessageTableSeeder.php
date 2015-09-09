<?php

namespace Lavalite\Message;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MessageTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('messages')->insert(array(
            // Uncomment  and edit this section for entering value to message table.
            /*
            array(
                'name'      => 'Some name',
            ),
            */

        ));

        DB::table('permissions')->insert(array(
            array(
                'name' => 'message.message.view',
                'readable_name' => 'View Message'
            ),
            array(
                'name' => 'message.message.create',
                'readable_name' => 'Create Message'
            ),
            array(
                'name' => 'message.message.edit',
                'readable_name' => 'Update Message'
            ),
            array(
                'name' => 'message.message.delete',
                'readable_name' => 'Delete Message'
            )
        ));

        DB::table('settings')->insert(array(
            // Uncomment  and edit this section for entering value to settings table.
            /*
            array(
                'key'      => 'message.message.key',
                'name'     => 'Some name',
                'value'    => 'Some value',
                'type'     => 'Default',
            ),
            */
        ));
    }
}
