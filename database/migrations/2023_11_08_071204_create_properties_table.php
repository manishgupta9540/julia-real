<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title',200)->nullable();
            $table->text('discription')->nullable();
            $table->integer('categoryes_id')->nullable();
            $table->string('listing_status',200)->nullable();
            $table->string('property_status',200)->nullable();
            $table->string('price',200)->nullable();
            $table->string('yearly_tax_rate',200)->nullable();
            $table->string('price_label',200)->nullable();
            $table->tinyInteger('status')->default('0')->comment('0 => Inactive, 1 => Active, 2 => Deleted')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
