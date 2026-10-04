<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'method',
        'network',
        'address',
        'tx_hash',
        'proof',
        'status',
        'note',
        'source',
        'sender_address',
        'confirmations',
        'explorer_url',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'confirmations' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Points at the authenticated admin route that streams the file, not a
     * public disk URL, so proofs stay private on shared hosting.
     */
    public function proofUrl(): ?string
    {
        if (! $this->proof) {
            return null;
        }

        return route('admin.deposits.proof', $this);
    }

    public function explorerUrl(): ?string
    {
        if (! $this->tx_hash) {
            return null;
        }

        if ($this->explorer_url) {
            return $this->explorer_url;
        }

        $template = config('crypto.networks.' . $this->network . '.explorer');

        return $template ? str_replace('{hash}', $this->tx_hash, $template) : null;
    }
}