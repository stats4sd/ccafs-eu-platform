<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShortNamesToLookupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pillars', function (Blueprint $table) {
            $table->string('short_name');
        });

        Schema::table('systems', function (Blueprint $table) {
            $table->string('short_name');
        });

        Schema::table('practices', function (Blueprint $table) {
            $table->string('short_name');
        });

        Schema::table('elements', function (Blueprint $table) {
            $table->string('short_name');
        });

        Schema::table('investments', function (Blueprint $table) {
            $table->string('short_name');
        });

        Schema::table('main_actions', function (Blueprint $table) {
            $table->string('short_name');
        });

        Schema::table('enable_envs', function (Blueprint $table) {
            $table->string('short_name');
        });

        Schema::table('scopes', function (Blueprint $table) {
            $table->string('short_name');
        });

        Schema::table('ipflows', function (Blueprint $table) {
            $table->string('short_name');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pillars', function (Blueprint $table) {
            $table->dropColumn('short_name');
        });

        Schema::table('systems', function (Blueprint $table) {
            $table->dropColumn('short_name');
        });

        Schema::table('practices', function (Blueprint $table) {
            $table->dropColumn('short_name');
        });

        Schema::table('elements', function (Blueprint $table) {
            $table->dropColumn('short_name');
        });

        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn('short_name');
        });

        Schema::table('main_actions', function (Blueprint $table) {
            $table->dropColumn('short_name');
        });

        Schema::table('enable_envs', function (Blueprint $table) {
            $table->dropColumn('short_name');
        });

        Schema::table('scopes', function (Blueprint $table) {
            $table->dropColumn('short_name');
        });

        Schema::table('ipflows', function (Blueprint $table) {
            $table->dropColumn('short_name');
        });
    }
}
