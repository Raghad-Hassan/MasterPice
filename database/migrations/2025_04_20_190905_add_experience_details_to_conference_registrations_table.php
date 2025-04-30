<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('conference_registrations', function (Blueprint $table) {
        $table->text('experience_details')->nullable()->after('previous_experience');
    });
}

public function down()
{
    Schema::table('conference_registrations', function (Blueprint $table) {
        $table->dropColumn('experience_details');
    });
}

};
