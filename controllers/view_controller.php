<?php
    class View {

        function __construct($name, $variables) {
            $this->name = $name;
            $this->values = array();
            foreach($variables as $key => $value) {
                $this->values[$key] = $value;
            }
        }

        function render() {
            $values = $this->values;
            require_once '../templates/header.php';
            require_once '../views/'.$this->name.'.php';
            require_once '../templates/footer.php';
        }

    }
    
?>