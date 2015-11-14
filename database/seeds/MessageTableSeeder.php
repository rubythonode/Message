<?php

namespace Lavalite\Message;

use DB;
use Illuminate\Database\Seeder;

class MessageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('messages')->insert([
            // Uncomment  and edit this section for entering value to message table.
            /*
            array(
               "id"        => "Id",
               "from"        => "From",
               "to"        => "To",
               "subject"        => "Subject",
               "message"        => "Message",
               "read"        => "Read",
               "type"        => "Type",
               "deleted_at"        => "Deleted at",
               "created_at"        => "Created at",
               "updated_at"        => "Updated at",
            ),
            */

        ]);

        DB::table('permissions')->insert([
            [
                'name'          => 'message.message.view',
                'readable_name' => 'View Message',
            ],
            [
                'name'          => 'message.message.create',
                'readable_name' => 'Create Message',
            ],
            [
                'name'          => 'message.message.edit',
                'readable_name' => 'Update Message',
            ],
            [
                'name'          => 'message.message.delete',
                'readable_name' => 'Delete Message',
            ],
        ]);

        DB::table('settings')->insert([
            // Uncomment  and edit this section for entering value to settings table.
            /*
            array(
                'key'      => 'message.message.key',
                'name'     => 'Some name',
                'value'    => 'Some value',
                'type'     => 'Default',
            ),
            */
        ]);
    }
}
