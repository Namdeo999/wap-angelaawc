<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWapRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wap_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('client_mobile');
            $table->string('template_id');
            $table->longText('message');
            $table->integer('approve_by')->default(0);
            $table->integer('approve')->default(0);
            $table->integer('reject')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wap_requests');
    }
}
