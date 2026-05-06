<?php 
declare(strict_types=1);

namespace App\Library\Config;

class LibraryConfig {
    private $libraryName;
    private $libraryAddress;
    private $libraryContact;

    public function __construct() {
        $this->libraryName = getenv('LIBRARY_NAME');
        $this->libraryAddress = getenv('LIBRARY_ADDRESS');
        $this->libraryContact = getenv('LIBRARY_CONTACT');
    }

    public function getLibraryName() {
        return $this->libraryName;
    }

    public function getLibraryAddress() {
        return $this->libraryAddress;
    }

    public function getLibraryContact() {
        return $this->libraryContact;
    }
}
?>