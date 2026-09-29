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
        Schema::create('file_manager_trashes', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('media_id')->unique();
            $table->unsignedBigInteger('folder_id')->nullable();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamp('deleted_at');
            $table->index('folder_id');
            $table->index('deleted_by');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_manager_trashes');
    }
};
