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
        Schema::create('animal_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('animal_id')->unsigned()->comment('動物ID');
            $table->bigInteger('user_id')->unsigned()->comment('使用者ID');
            $table->timestamps();
        });

        Schema::table('animal_user', function (Blueprint $table) {

            // user_id 外鍵
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            // animal_id 外鍵
            $table->foreign('animal_id')
                ->references('id')->on('animals')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('animal_user', function (Blueprint $table) {
            // 刪除外鍵約束 （這個表名_外鍵名_foreign）
            $table->dropForeign('animal_user_user_id_foreign');
            $table->dropForeign('animal_user_animal_id_foreign');
        });
        
        Schema::dropIfExists('animal_user');
    }
};
