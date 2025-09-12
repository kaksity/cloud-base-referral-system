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
            $table->uuid('organization_id')->index();
            $table->uuid('location_id')->index();
            $table->text('services');
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
