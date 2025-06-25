<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lucky_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('magic_link_id')->constrained('magic_links')->onDelete('cascade');
            $table->integer('random_number');
            $table->string('result');
            $table->decimal('win_amount');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lucky_results');
    }
};
