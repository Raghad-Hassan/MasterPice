<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToVolunteerOpportunitiesTable extends Migration
{
    public function up()
    {
        Schema::table('volunteer_opportunities', function (Blueprint $table) {
            // إضافة حقل transportation_available (افتراضيًا false)
            $table->boolean('transportation_available')->default(false);

            // إضافة حقل max_volunteers
            $table->integer('max_volunteers')->nullable();
        });
    }

    public function down()
    {
        Schema::table('volunteer_opportunities', function (Blueprint $table) {
            // حذف الحقول في حالة التراجع عن المهاجر
            $table->dropColumn('transportation_available');
            $table->dropColumn('max_volunteers');
        });
    }
}
