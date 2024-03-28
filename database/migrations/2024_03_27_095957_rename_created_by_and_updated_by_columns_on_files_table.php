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
        Schema::table('files', function(Blueprint $table) {
            $table->renameColumn('created_by', 'creator_id');
            $table->renameColumn('updated_by', 'updater_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function(Blueprint $table) {
            $table->renameColumn('creator_id', 'created_by');
            $table->renameColumn('updater_id', 'updated_by');
        });
    }
};
