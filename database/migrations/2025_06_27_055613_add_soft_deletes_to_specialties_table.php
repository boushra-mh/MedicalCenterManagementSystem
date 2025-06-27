<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToSpecialtiesTable extends Migration
{
    public function up()
    {
        Schema::table('specialties', function (Blueprint $table) {
            $table->softDeletes();  // يضيف عمود deleted_at
        });
    }

    public function down()
    {
        Schema::table('specialties', function (Blueprint $table) {
            $table->dropSoftDeletes();  // لحذف العمود إذا رجعت الهجرة
        });
    }
}

