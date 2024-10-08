<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('message_recipients', function (Blueprint $table) {
            $table->string('failure_reason')->nullable()->after('sent_status');
        });
    }

    public function down(): void
    {
        Schema::table('message_recipients', function (Blueprint $table) {
            $table->dropColumn('failure_reason');
        });
    }
};
