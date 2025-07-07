<?php

namespace App;

class InvoiceCollection implements \Iterator //, \IteratorAggregate
{

    // ref : https://www.php.net/manual/en/spl.iterators.php
    // https://www.php.net/manual/en/language.oop5.iterations.php
    // https://www.php.net/manual/en/language.types.iterable.php
    // https://www.php.net/manual/en/class.iterator.php
    // https://www.php.net/manual/en/class.iteratoraggregate.php



    public function __construct(public array $invoices = [])
    {
    }

    public function current(): mixed
    {
        echo __METHOD__ . "<br>";
        // Return the current element in the invoices array
        // This is the element that the iterator is currently pointing to
        // If you don't call current(), the iterator will always return the first element
        return current($this->invoices);
    }

    public function next(): void
    {   
        echo __METHOD__ . "<br>";
        // Move the internal pointer to the next element in the invoices array
        // This is necessary to iterate through the collection
        // If you don't call next(), the iterator will always return the first element
        next($this->invoices);
    }
    public function key(): mixed
    {
        
        echo __METHOD__ . "<br>";
        // Return the current key of the iterator
        // This is the key of the current element in the invoices array
        // If you don't call key(), the iterator will always return the first key
        // This is useful for associative arrays where keys are not numeric
        // If the iterator is at the end of the array, key() will return null
        return key($this->invoices);
    }

    public function valid(): bool
    {
        
        echo __METHOD__ . "<br>";
        // Check if the current key is not null, indicating that there are still invoices to iterate over
        // This is a simple way to check if the iterator is still valid
        // Alternatively, you could also check if the current value is not false or null

        return key($this->invoices) !== null;
    }

    public function rewind(): void
    {
        echo __METHOD__ . "<br>";
        // Reset the internal pointer to the first element in the invoices array
        // This is necessary to start iterating from the beginning of the collection
        // If you don't call rewind(), the iterator will always start from the current position
        // This is useful when you want to iterate over the collection multiple times
        reset($this->invoices);
    }

    /*
    public function getIterator(): \Traversable
    {
        echo __METHOD__ . "<br>";
        // Return an instance of the iterator for the invoices array
        // This is necessary to implement the \IteratorAggregate interface
        // The \Traversable interface is implemented by the \Iterator interface 
        // This allows the collection to be used in a foreach loop
        return new \ArrayIterator($this->invoices);
    }
    */

}