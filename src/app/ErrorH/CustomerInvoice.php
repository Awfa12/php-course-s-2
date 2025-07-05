<?php 

namespace App\ErrorH;

class CustomerInvoice {
    public function __construct(public Customer $customer){
        
    }

    public function process(float $amount): void {

        if ($amount <= 0) {
            throw new \InvalidArgumentException("Amount must be greater than zero.");
        }

        if( empty($this->customer->getBillingInfo())) {
            throw new MissingBillingInfoException();
        }

        // another approach to handle the exception
        if ($amount <= 0) {
            throw InvoiceException::invalidAmount();
        }

        if( empty($this->customer->getBillingInfo())) {
            throw InvoiceException::missingBillingInfo();
        }

        echo "Processing" . $amount . "invoice<br>";

        sleep(1); // Simulating a delay for processing

        echo "OK<br>";
    }
}