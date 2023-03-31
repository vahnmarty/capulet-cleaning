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
        Schema::table('properties', function (Blueprint $table) {
            $table->string('listing_title')->nullable();
            $table->string('image_url')->nullable();
            $table->string('status')->nullable();
            $table->string('email2')->nullable();
            $table->string('preferred_contact_method')->nullable();
            $table->string('link')->nullable();
            $table->integer('bedroom_count');
            $table->integer('king_count')->nullable();
            $table->integer('queen_count')->nullable();
            $table->integer('twin_count')->nullable();
            $table->integer('full_count')->nullable();
            $table->integer('bunk_count')->nullable();
            $table->integer('trundle_count')->nullable();
            $table->integer('bathrooms');
            $table->string('access_code')->nullable();
            $table->string('parking')->nullable();
            $table->string('alarm_code')->nullable();
            $table->boolean('sheets')->default(false);
            $table->string('trash_day')->nullable();
            $table->string('recycling')->nullable();
            $table->string('set_up_date')->nullable();
            $table->string('checkout_method')->nullable();
            $table->string('coffee_pot_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropColumn('listing_title')->nullable();
        $table->dropColumn('status')->nullable();
        $table->dropColumn('email2')->nullable();
        $table->dropColumn('preferred_contact_method')->nullable();
        $table->dropColumn('link')->nullable();
        $table->dropColumn('bedroom_count');
        $table->dropColumn('king_count')->nullable();
        $table->dropColumn('queen_count')->nullable();
        $table->dropColumn('twin_count')->nullable();
        $table->dropColumn('full_count')->nullable();
        $table->dropColumn('bunk_count')->nullable();
        $table->dropColumn('trundle_count')->nullable();
        $table->dropColumn('bathrooms');
        $table->dropColumn('access_code')->nullable();
        $table->dropColumn('parking')->nullable();
        $table->dropColumn('alarm_code')->nullable();
        $table->dropColumn('sheets')->default(false);
        $table->dropColumn('trash_day')->nullable();
        $table->dropColumn('recycling')->nullable();
        $table->dropColumn('set_up_date')->nullable();
        $table->dropColumn('checkout_method')->nullable();
        $table->dropColumn('coffee_pot_type')->nullable();
    }
};
