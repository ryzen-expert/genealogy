<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('people', function (Blueprint $table) {

            $table->after('firstname', function ($table) {
                $table->string('father_name')->nullable();
                $table->string('first_grandfather')->nullable();
                $table->string('second_grandfather')->nullable();
                $table->string('third_grandfather')->nullable();
            });

            $table->foreignId('created_by')->nullable()->after('surname');
        });

        Schema::table('couples', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('team_id');
        });

    }

    public function down(): void
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropColumn(['father_name', 'first_grandfather', 'second_grandfather', 'third_grandfather', 'created_by']);
        });

        Schema::table('couples', function (Blueprint $table) {
            $table->dropColumn(['created_by']);
        });

    }
};
