<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cat_items', function (Blueprint $table) {
            $table->id();
            $table->string('at_no');
            $table->string('descripcion')->nullable();
            $table->string('descripcion_compra')->nullable();
            $table->integer('max_cap');
            $table->timestamps();
        });

        Schema::create('item_register', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_item_id');
            $table->integer('cantidad');
            $table->date('f_compra')->nullable()->default(null);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cat_items');
        Schema::dropIfExists('item_register');
    }
};
