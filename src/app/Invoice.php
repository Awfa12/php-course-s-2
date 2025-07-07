<?php 

namespace App;

class Invoice
{
    protected array $data;
    private int $id = 1;

    public function __construct(public float $amount = 0, public string $description = "No description provided"){
        $this->data = [
            'amount' => $amount,
            'description' => $description,
        ];
        
    }

    public function index(): string
    {
        unset($_SESSION['count']);
        var_dump($_SESSION);
        return "Welcome to the Invoice Page!";
    }

    public function create(): string
    {
        echo '<pre>';
        var_dump("Creating invoice with the following data:");
        var_dump($_REQUEST);
        echo '</pre>';

        echo '<pre>';
        var_dump("GET data received:");
        var_dump($_GET);
        echo '</pre>';

        echo '<pre>';
        var_dump("POST data received:");
        var_dump($_POST);
        echo '</pre>';

        $this->processPayment($this->amount, $this->description);
        return '<form method="post" action="/invoices/create">
                <label for="amount">Amount:</label>
                <input type="number" name="amount" id="amount" value="' . htmlspecialchars($this->amount) . '" required>
                <br>
                <label for="description">Description:</label>
                <input type="text" name="description" id="description" value="' . htmlspecialchars($this->description) . '" required>
                <br>
                <button type="submit">Create Invoice</button>
            </form>';

    }

    public function store() {
        $amount = $_POST['amount'] ?? 0;
        $description = $_POST['description'] ?? 'No description provided';

        var_dump("Storing invoice with amount: {$amount} and description: {$description}");
        echo "<br>";
    }

    public function __clone()
    {
        // Custom logic for cloning if needed
        $this->id = rand(1, 1000); // Assign a new random ID for the cloned object
        $this->data['amount'] = $this->data['amount'] * 0.9; // Example: apply a discount on the cloned invoice
        var_dump("Cloned Invoice with new ID: {$this->id} and discounted amount: {$this->data['amount']}");
        echo "<br>";
    }

    public function __get(string $name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return null;
    }

    public function __set(string $name, $value): void
    {
        $this->data[$name] = $value;
    }

    public function __isset(string $name): bool
    {
        return isset($this->data[$name]);
    }

    public function __unset(string $name): void
    {
        unset($this->data[$name]);
    }

    protected function processPayment(float $amount ,string $description) {
        var_dump("Processing payment of \${$amount} for {$description}");
        echo "<br>";
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        } else {
            var_dump("Method {$name} does not exist in " . __CLASS__);
            var_dump("Arguments: " . implode(', ', $arguments));
            echo "Please check the method name or parameters.<br>";
        }

        
    }

    public static function __callStatic($name, $arguments)
    {
        if (method_exists(__CLASS__, $name)) {
            return call_user_func_array([__CLASS__, $name], $arguments);
        } else {
            var_dump("Static method {$name} does not exist in " . __CLASS__);
            var_dump("Arguments: " . implode(', ', $arguments));
            echo "Please check the static method name or parameters.<br>";
        }
    }

    public function __toString(): string
    {
        $output = "Invoice Details:<br>";
        foreach ($this->data as $key => $value) {
            $output .= ucfirst($key) . ": " . $value . "<br>";
        }
        return $output;
    }

    public function __invoke()
    {

        var_dump("Invoice invoked as a function.");
        echo "<br>";
        
    }

    public function __debugInfo(): array
    {
        $debugInfo = [];
        foreach ($this->data as $key => $value) {
            $debugInfo[$key] = $value;
        }
        $debugInfo['id'] = $this->id;
        $debugInfo['class'] = __CLASS__;
        return $debugInfo;
    }

    /**
     * Handles object serialization and unserialization for the Invoice class.
     *
     * There are two pairs of magic methods implemented:
     *
     * 1. __sleep() and __wakeup():
     *    - __sleep(): Returns an array of property names to be serialized when using the old `serialize()` function.
     *    - __wakeup(): Called upon unserialization with `unserialize()`. Used here to reset or reinitialize properties (e.g., resetting `$id` to 1).
     *
     * 2. __serialize() and __unserialize():
     *    - __serialize(): Returns an associative array of property values to be serialized, used by the newer serialization mechanism (PHP 7.4+).
     *    - __unserialize(array $data): Called upon unserialization with the new mechanism. Used to restore property values from the provided array.
     *
     * Note:
     * - __sleep() / __wakeup() are for legacy serialization.
     * - __serialize() / __unserialize() are recommended for PHP 7.4+ and provide more control and flexibility.
     * - Both pairs are implemented for compatibility with different PHP versions and serialization mechanisms.
     */
    public function __sleep(): array
    {
        // Specify which properties to serialize
        return ['data', 'id'];
    }

    public function __wakeup(): void
    {
        // Reinitialize properties after unserialization
        $this->id = 1; // Reset ID or perform any other necessary initialization
        var_dump("Invoice object has been unserialized and ID reset to {$this->id}");
        echo "<br>";
    }

    public function __serialize(): array
    {
        // Specify which properties to serialize
        return [
            'data' => $this->data,
            'id' => $this->id,
            'class' => __CLASS__,
        ];
    }

    public function __unserialize(array $data): void
    {
        // Reinitialize properties after unserialization
        $this->data = $data['data'];
        $this->id = $data['id'];
        var_dump("Invoice object has been unserialized with ID: {$this->id}");
        echo "<br>";
    }
}