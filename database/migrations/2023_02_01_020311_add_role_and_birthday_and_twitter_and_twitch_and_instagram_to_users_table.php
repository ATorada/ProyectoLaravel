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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['member', 'admin'])->default('member');
            $table->date('birthday')->nullable();
            $table->string('twitter', 100)->nullable();
            $table->string('twitch', 100)->nullable();
            $table->string('instagram', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('birthday');
            $table->dropColumn('twitter');
            $table->dropColumn('twitch');
            $table->dropColumn('instagram');
        });
    }
};
