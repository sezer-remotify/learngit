<?php

/**
 * Join
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2017
 * @version $Id: verify.tpl.php, v1.00 2018-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
    die('Direct access to this location is not allowed.');
?>
<div class="login-wrapper">
    <div class="wojo login segment">
        <div class="wojo form">
            <br>
            <div class="icon-box" style="display: flex; justify-content:center;"><img width="130" height="130" src="<?php echo ADMINVIEW; ?>/images/verification.svg"></div>
            <br>
            <br>
            <h1 class="center aligned"><?php echo str_replace("[COMPANY]", $this->core->company, Lang::$word->META_WELCOME); ?>!</h1>
            <p class="center aligned"><?php echo Lang::$word->DASH_INFO_4; ?></p>
            <br>
            <div class="center aligned">
                <button type="button" onclick="location.href='https://remotify.co/app/panel/';" class="wojo secondary button margin-bottom-20 btn-one"><?php echo Lang::$word->LOGIN; ?></button>
            </div>
        </div>
    </div>
</div>