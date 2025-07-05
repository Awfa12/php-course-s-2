<?php 

namespace App\ErrorH;

class MissingBillingInfoException extends \Exception
{
    protected $message = 'Billing information is missing for the customer.';

}