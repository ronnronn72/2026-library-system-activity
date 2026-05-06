<?php 
declare(strict_types=1);

namespace App\Library\Exception;

class ValidationException extends Exception {
    public function __construct($message = "Validation error occurred", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
?>