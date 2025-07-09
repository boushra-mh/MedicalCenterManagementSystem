<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailLogsTable extends Migration
{
    public function up()
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->id();
            $table->string('to_email'); // عمود البريد المرسل إليه
            $table->string('subject')->nullable(); // موضوع البريد
            $table->text('body')->nullable(); // محتوى البريد
            $table->morphs('emailable'); // لربط polymorphic relation
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_logs');
    }
}
