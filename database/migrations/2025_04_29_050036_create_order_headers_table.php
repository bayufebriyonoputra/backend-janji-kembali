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
        Schema::create('order_headers', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tgl_order');
            $table->foreignId('member_id')->constrained('members', 'id')->cascadeOnDelete();
            $table->enum('status',['new', 'processed', 'done']);
            $table->string('code')->unique();
            $table->foreignId('payment_id')->constrained('payments', 'id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_headers');
    }
};
