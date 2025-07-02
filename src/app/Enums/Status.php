<?php 

namespace App\Enums;

// ref https://wiki.php.net/rfc/enumerations

class Status {
    public const PAID = 'paid';
    public const PENDING = 'pending';
    public const DECLINED = 'declined';

    public const ALL_STATUS = [
        self::PAID => 'Paid',
        self::PENDING => 'Pending',
        self::DECLINED => 'Declined',
    ];
}