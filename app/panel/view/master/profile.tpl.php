<?php

/**
 * Companies
 *
 * @package Wojo Framework
 * @author  https://ilyaskohistani.github.io/
 * @copyright 2021
 * @version $Id: profile.tpl.php, v1.00 18-03-2021 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');

// if (!Auth::hasPrivileges('manage_companies')) : print Message::msgError(Lang::$word->NOACCESS);
//   return;
// endif;
?>
<?php switch (Url::segment($this->segments)):
  case "edit": ?>
    <!-- Edit Profile -->
    <?php
    if (App::Auth()->is_Freelancer($this->row->userlevel, $this->row->type, false)) : include("_freelancer_edit.tpl.php");
    elseif (App::Auth()->is_Client($this->row->userlevel, $this->row->type, false)) :  include("_client_edit.tpl.php");
    endif; ?>
    <?php break; ?>
  <?php
  case "complete": ?>
    <!-- Complete Profile -->
    <?php include("_freelancer_complete.tpl.php"); ?>
    <?php break; ?>
  <?php
  case "view": ?>
    <!-- View Public Profile -->
    <?php
    if (App::Auth()->is_Freelancer($this->row->userlevel, $this->row->type, false)) : include("_freelancer_view.tpl.php");
    elseif (App::Auth()->is_Client($this->row->userlevel, $this->row->type, false)) :  include("_client_view.tpl.php");
    endif; ?>
    <?php break; ?>
  <?php
  default: ?>
    <?php Url::redirect(Url::url("/master/")); ?>
    <?php break; ?>
<?php endswitch; ?>