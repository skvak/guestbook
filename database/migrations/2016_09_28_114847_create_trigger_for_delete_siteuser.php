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
        SELECT count(user_id) INTO m FROM messages WHERE messages.user_id=old.user_id;
        IF m = 1 THEN
        DELETE FROM siteusers WHERE siteusers.id=old.user_id;
        END IF;
        DELETE from files where files.id=old.file_id;
        END
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
