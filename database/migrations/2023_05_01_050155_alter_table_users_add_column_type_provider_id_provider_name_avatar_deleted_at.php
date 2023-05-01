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
            $table->enum('type', ['Admin', 'User'])->default('User')->after('password');
            $table->string('provider_id')->nullable()->after('type');
            $table->string('provider_name')->nullable()->after('provider_id');
            $table->string('avatar')->nullable()->after('provider_name');
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
            $table->dropColumn(['type', 'provider_id', 'provider_name', 'avatar']);
        });
    }
};
