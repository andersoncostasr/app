<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplySupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reply_support', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('support_id')->index();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('description');
            $table->timestamps();

            $table->foreign('support_id')
                ->references('id')
                ->on('supports')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reply_supports');
    }
}
