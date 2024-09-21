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
        

        Schema::table('item_register', function (Blueprint $table) {
            $table->integer('bodega_id')->nullable()->default(null);
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_register', function (Blueprint $table) {
            $table->dropColumn('bodega_id');
            
        });
        
        
    }
};
