<?php
    class NotAuthorized extends Exception {}
    class InvalidInput extends Exception {}
    class NotImplemented extends Exception {
        private $functionName;

        public function __construct( $function = '(unknown method)' ) {
            $this->functionName = $function;
            parent::__construct( 'Not implemented', 0, null );
        }
        public function getFunctionName() {
            return $this->functionName;
        }
    }
    class RedirectException extends Exception {
        private $url;

        public function getURL() {
            return $this->url;
        }
        public function __construct( $url ) {
            $this->url = $url;
            parent::__construct( 'URL exception', 0, null );
        }
    }

    session_start();
    function Redirect( $url = '' ) {
        throw new RedirectException( $url );
    }
    function view( $path, $variables = false) {
        if ( $variables === false ) {
            $variables = array();
        }
        extract( $variables );
        include 'views/header.php';
        include 'views/' . $path . '.php';
        include 'views/footer.php';
    }
    global $settings;
    $settings = include 'settings.php';
    include 'models/db.php';
    // TODO: include other models here
?>
