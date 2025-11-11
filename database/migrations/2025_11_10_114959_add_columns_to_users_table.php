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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['manager', 'borrower'])->default('borrower')->after('email');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('role');
            $table->foreignId('library_id')->nullable()->constrained('libraries')->nullOnDelete()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('status');
            $table->dropColumn('library_id');
        });
    }
};
