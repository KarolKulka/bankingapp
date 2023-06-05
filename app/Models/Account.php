<?php

namespace App\Models;

use App\Enums\AccountBalanceStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'name',
        'number',
        'balance',
        'user_id',
    ];

    protected $dispatchesEvents = [
        'creating'
    ];

    public $timestamps = false;

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('date', 'ASC');
    }

    protected static function booted()
    {
        parent::booted();

        static::creating(function (Account $account) {

            $previousNumber = 76;
            $accountNumber = "";
            for ($i = 0; $i < 12; $i++){
                do {
                    $currentRnd = random_int(10, 99);
                }while ($currentRnd === $previousNumber);

                $accountNumber .= $currentRnd;
                $previousNumber = $currentRnd;
            }

            $account->number = $accountNumber;
        });
    }

    public function balanceStatus()
    {
        return $this->balance >= 0 ? AccountBalanceStatus::Afloat : AccountBalanceStatus::Debt;
    }

    public function formatSaldo()
    {
        return number_format($this->balance, 2, ",", " ");
    }

    public function currencySaldo()
    {
        return $this->formatSaldo() . " zł";
    }
}
