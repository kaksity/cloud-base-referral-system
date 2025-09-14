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
        Schema::create('case_workers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('current_organization_id')->index();
            $table->uuid('added_by_system_admin_id')->nullable()->index();
            $table->uuid('added_by_organization_admin_id')->nullable()->index();
            $table->uuid('current_location_id')->index();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email');
            $table->string('password');
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_workers');
    }
};
