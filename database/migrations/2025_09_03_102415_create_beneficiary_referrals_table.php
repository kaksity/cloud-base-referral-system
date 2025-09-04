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
        Schema::create('beneficiary_referrals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('beneficiary_id')->index();
            $table->string('organization_id')->index();
            $table->string('location_id')->index();
            $table->string('service_id')->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiary_referrals');
    }
};
