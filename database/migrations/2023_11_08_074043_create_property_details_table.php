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
        Schema::create('property_details', function (Blueprint $table) {
            $table->id();
            $table->integer('properti_id')->nullable();
            $table->integer('size_in_ft')->nullable();
            $table->integer('lot_size_in_ft')->nullable();
            $table->integer('rooms')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('custom_id')->nullable();
            $table->string('garages')->nullable();
            $table->string('garage_size')->nullable();
            $table->integer('year_built')->nullable();
            $table->date('available_date')->nullable();
            $table->string('basement')->nullable();
            $table->string('extra_details')->nullable();
            $table->string('roofing')->nullable();
            $table->string('exterior_material')->nullable();
            $table->string('structure_type')->nullable();
            $table->string('floors_no')->nullable();
            $table->text('agent_notes')->nullable();
            $table->string('energy_class')->nullable();
            $table->string('energy_index')->nullable();
            $table->string('amenities_id')->nullable();
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
        Schema::dropIfExists('property_details');
    }
};
