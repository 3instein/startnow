<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('position');
            $table->integer('typeable_id');
            $table->string('typeable_type');
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
        Schema::dropIfExists('join_requests');
    }
}
