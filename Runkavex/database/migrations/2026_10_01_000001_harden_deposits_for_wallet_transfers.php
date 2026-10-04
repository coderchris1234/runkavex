<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->string('source', 20)->default('manual')->after('network');
            $table->string('sender_address', 255)->nullable()->after('source');
            $table->unsignedInteger('confirmations')->nullable()->after('sender_address');
            $table->string('explorer_url', 500)->nullable()->after('confirmations');
        });

        $this->createUniqueTxHashIndex();
    }

    public function down(): void
    {
        $this->dropUniqueTxHashIndex();

        Schema::table('deposits', function (Blueprint $table) {
            $table->dropColumn(['source', 'sender_address', 'confirmations', 'explorer_url']);
        });
    }

    /**
     * Guard against the same on-chain transaction being credited twice.
     *
     * NULL hashes must stay allowed, because admin-created MANUAL- rows carry no
     * hash. Both SQLite and MySQL treat NULLs as distinct inside a UNIQUE index,
     * so a plain index gives the right behaviour on either driver.
     *
     * SQLite and MySQL disagree on partial indexes and on `IF NOT EXISTS`, so the
     * existence check is done through the schema builder rather than raw DDL.
     */
    private function createUniqueTxHashIndex(): void
    {
        if ($this->uniqueTxHashIndexExists()) {
            return;
        }

        Schema::table('deposits', function (Blueprint $table) {
            $table->unique('tx_hash', 'deposits_tx_hash_unique');
        });
    }

    private function dropUniqueTxHashIndex(): void
    {
        if (! $this->uniqueTxHashIndexExists()) {
            return;
        }

        Schema::table('deposits', function (Blueprint $table) {
            $table->dropUnique('deposits_tx_hash_unique');
        });
    }

    private function uniqueTxHashIndexExists(): bool
    {
        foreach (Schema::getIndexes('deposits') as $index) {
            if ($index['name'] === 'deposits_tx_hash_unique') {
                return true;
            }
        }

        return false;
    }
};