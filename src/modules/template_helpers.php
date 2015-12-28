<?php

require_once(realpath(dirname(__FILE__) . "/../config.php"));

function render($contentFile, $variables = array())
{
    $content = TEMPLATES_PATH . "/" . $contentFile . ".php";

    if (count($variables) > 0) {
        foreach ($variables as $key => $value) {
            if (strlen($key) > 0) {
                ${$key} = $value;
            }
        }
    }

    require_once(TEMPLATES_PATH . "/base/header.php");

    echo "<section role='main'>";

    if (isset($_SESSION['flash']) && $_SESSION['flash'] != "") {
        echo "
            <div class='row'>
            <div data-alert class='alert-box alert' style='margin-bottom: 0;margin-top: 1.25rem'>
                " . $_SESSION['flash'] . "
                <a href='#' class='close'>&times;</a>
            </div></div>";

        unset($_SESSION['flash']);
    }

    if (file_exists($content)) {
        require_once($content);
    } else {
        require_once(TEMPLATES_PATH . "/base/error.php");
    }

    echo "</section>";

    require_once(TEMPLATES_PATH . "/base/footer.php");
}

?>
