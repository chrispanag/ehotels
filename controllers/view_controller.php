<?php
    class View {

        function __construct($name, $variables, $type = "View") {
            $this->name = $name;
            $this->type = $type;
            $this->values = array();
            foreach($variables as $key => $value) {
                $this->values[$key] = $value;
            }
        }

        function render() {
            $values = $this->values;
            $type = $this->type;
            extract($values, EXTR_SKIP);
            require_once '../templates/header.php';
            require_once '../views/'.$this->name.'.php';
            require_once '../templates/footer.php';
        }

    }
    
?>