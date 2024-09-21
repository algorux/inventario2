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
        Schema::table('cat_items', function (Blueprint $table) {
            $table->renameColumn('at_no', 'inv_no');
            $table->string('at_no')->after('inv_no')->nullable();
            $table->string('responsable')->after('descripcion_compra')->nullable();
        });

        Schema::table('item_register', function (Blueprint $table) {
            
            $table->date('f_estimada_ent')->after('f_compra')->nullable()->default(null);
            $table->date('f_entrega')->after('f_estimada_ent')->nullable()->default(null);
            $table->string('status')->after('f_entrega')->nullable();
        });

        Schema::create('cat_bodegas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cat_items', function (Blueprint $table) {
            $table->dropColumn('at_no');
            $table->renameColumn('inv_no', 'at_no');
            $table->dropColumn('responsable');
            
        });
        Schema::table('item_register', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('f_estimada_ent');
            $table->dropColumn('f_entrega');
        });
        Schema::dropIfExists('cat_bodegas');
        
    }
};
