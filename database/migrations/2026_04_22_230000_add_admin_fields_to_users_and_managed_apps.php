<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('password');
            $table->softDeletes();
        });

        Schema::create('managed_apps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('api_url');
            $table->string('api_token')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('admin_app_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('managed_app_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->primary(['user_id', 'managed_app_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_app_user');
        Schema::dropIfExists('managed_apps');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['is_active']);
            $table->dropSoftDeletes();
        });
    }
};
