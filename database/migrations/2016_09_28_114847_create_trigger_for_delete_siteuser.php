<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerForDeleteSiteuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER delete_user BEFORE DELETE ON `messages` FOR EACH ROW
        BEGIN
        DECLARE m INT;
        SELECT count(user_id) into m from messages where messages.user_id=old.user_id;
        if m = 1 then
        delete from siteusers where siteusers.id=old.user_id;
        end if;
        end
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `delete_user`');
    }
}
