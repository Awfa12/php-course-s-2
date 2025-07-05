<?php 

namespace App;

// Adding Comments to Classes & Methods


/**
 * CustomInvoice class extends the Invoice class.
 * This class provides custom processing logic for invoices.
 * * @package App
 * @property string $invoiceNumber The unique identifier for the invoice.
 * @property-read string $invoiceNumber The unique identifier for the invoice.
 * @property-write string $invoiceNumber The unique identifier for the invoice.
 * 
 * @method process(string $customer, float $amount) Process the invoice for a customer with a specified amount.
 * 
 * ref: https://docs.phpdoc.org/guide/guides/docblocks.html
 */
class CustomInvoice extends Invoice
{
    // docblock for the property
    /**
     * @var string The invoice number.  
     * This property holds the unique identifier for the invoice.
     * @example "INV-12345"
     * @access private
     * 
     */
    private $invoiceNumber;
    


    // docblock for the method
    /**
     * Custom processing logic for the invoice.
     * @param string $customer The customer name.
     * @param float $amount The amount to be processed.
     * 
     * @return bool Returns true if processing is successful, false otherwise.
     * 
     * @throws \Exception If processing fails.
     */
    public function process($customer, $amount): bool
    {
        // Validate parameters
        if (empty($customer) || $amount <= 0) {
            throw new \Exception("Invalid customer or amount.");
        }
        // Custom processing logic for the invoice
        echo "Processing custom invoice for customer: " . $customer . " with amount: $" . $amount . "<br>";

        return true; // Indicating success

    }
}