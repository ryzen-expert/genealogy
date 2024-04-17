<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domain');
            $table->foreignId('team_id')->constrained();
            $table->boolean('is_paid')->default(false);
            $table->boolean('is_active')->default(false);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            $table->unique(['domain','team_id']);

        });

//        INSERT INTO `domains` (`id`, `domain`, `team_id`, `is_paid`, `is_active`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
//    ('1', 'altwijry', '19', '1', '1', '2024-04-17 00:32:26', '2037-04-17 00:32:26', NULL, NULL);
    }

    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
