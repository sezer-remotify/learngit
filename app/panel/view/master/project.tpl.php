<?php

/**
 * Companies
 *
 * @package Wojo Framework
 * @author  https://ilyaskohistani.github.io/
 * @copyright 2021
 * @version $Id: project.tpl.php, v1.00 18-03-2021 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');

// if (!Auth::hasPrivileges('manage_companies')) : print Message::msgError(Lang::$word->NOACCESS);
//   return;
// endif;
?>
<?php
switch (Url::segment($this->segments)):
  case "view": ?>
    <?php
    if (in_array(Auth::$udata->uid, array_values(get_object_vars($this->puRow))))
      include("_project_view.tpl.php");
    else {
      Url::redirect(Url::url("/"));
      exit;
    }
    ?>
    <?php break; ?>
  <?php
  case "new": ?>
    <?php
    include("_project_add.tpl.php");
    ?>
    <?php break; ?>
  <?php
  default: ?>
    <?php Url::redirect(Url::url("/"));
    ?>
    <?php break; ?>
<?php endswitch; ?>