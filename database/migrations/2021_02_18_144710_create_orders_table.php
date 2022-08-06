<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1);
            $table->foreignId('courier_id')->nullable()->constrained('couriers')->onDelete('set null');
            $table->decimal('sum_to_pay', 8, 2)->nullable();
            $table->decimal('current_lon', 10, 5)->nullable();
            $table->decimal('current_lat', 10, 5)->nullable();
            $table->string('from_street')->nullable();
            $table->string('from_building')->nullable();
            $table->string('from_room_number')->nullable();
            $table->string('from_floor')->nullable();
            $table->string('from_intercom')->nullable();
            $table->decimal('from_long', 10, 5);
            $table->decimal('from_lat', 10, 5);
            $table->string('to_street')->nullable();
            $table->string('to_building')->nullable();
            $table->string('to_room_number')->nullable();
            $table->string('to_floor')->nullable();
            $table->string('to_intercom')->nullable();
            $table->decimal('to_long', 10, 5);
            $table->decimal('to_lat', 10, 5);
            $table->string('vehicle_type')->nullable();
            $table->softDeletes();
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::dropIfExists('orders');
    }
}
