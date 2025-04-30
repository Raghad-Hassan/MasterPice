<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUserIdNullableInOrganizationsTable extends Migration
{
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
      
            $table->unsignedBigInteger('user_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
           
            $table->unsignedBigInteger('user_id')->nullable(false)->change();
        });
    }
}
