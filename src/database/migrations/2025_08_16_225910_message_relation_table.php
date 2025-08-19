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
        Schema::create('message_relation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('destination_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('sold_item_id')->constrained('sold_items')->cascadeOnDelete();
            $table->integer('message_count')->default(0);

            $table->unique(['user_id', 'destination_user_id', 'sold_item_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
