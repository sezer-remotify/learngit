<?php

/**
 * Members
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _members_grid.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->PEOPLE; ?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->MAC_INFO; ?></p>
  </div>
</div>
<div class="row gutters align bottom">
  <div class="columns phone-100">
    <div class="wojo small white stacked buttons">
      <a href="<?php echo Url::url("/admin/members", "invite"); ?>" class="wojo button"><?php echo Lang::$word->MAC_INVPEOPLE; ?></a>
      <a href="<?php echo Url::url("/admin/companies", "new"); ?>" class="wojo button"><?php echo Lang::$word->CMP_NEW; ?></a>
      <a href="<?php echo Url::url("/admin/teams"); ?>" class="wojo button"><?php echo Lang::$word->TMS_TEAMS; ?></a>
      <a href="<?php echo Url::url("/admin/members", "archive"); ?>" class="wojo button"><?php echo Lang::$word->ARCHIVE; ?></a>
      <a href="<?php echo Url::url("/admin/members", "freelancers"); ?>" class="wojo button"><?php echo Lang::$word->FREELANCERS; ?></a>
    </div>
  </div>
  <div class="columns auto phone-100">
    <a class="wojo small basic disabled icon button"><i class="icon grid"></i></a>
    <a href="<?php echo Url::url("/admin/members"); ?>" class="wojo small primary icon button"><i class="icon reorder"></i></a>
  </div>
</div>
<div class="wojo segment form">
  <div class="wojo form">
    <form method="post" id="wojo_form" action="<?php echo Url::url(Router::$path); ?>" name="wojo_form">
      <div class="wojo fields">
        <div class="field">
          <div class="wojo icon input">
            <input name="fromdate" type="text" placeholder="<?php echo Lang::$word->FROM; ?>" readonly id="fromdate">
            <i class="icon calendar alt"></i>
          </div>
        </div>
        <div class="field">
          <div class="wojo action input">
            <input name="enddate" type="text" placeholder="<?php echo Lang::$word->TO; ?>" readonly id="enddate">
            <button id="doDates" class="wojo icon primary inverted button"><i class="icon find"></i></button>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="center aligned"><?php echo Validator::alphaBits(Url::url("/admin/members/grid"), "letter", "wojo small horizontal link divided list align center"); ?></div>
</div>
<?php if ($this->data['hcmp']) : ?>
  <!-- Start users with companies-->
  <div class="wojo mason">
    <?php foreach ($this->data['hcmp'] as $company) : ?>
      <div class="item" id="cmp_<?php echo $company['id']; ?>">
        <div class="wojo attached card">
          <div class="header divided">
            <div class="row align middle">
              <div class="columns">
                <h5 class="basic">
                  <a href="<?php echo Url::url("/admin/companies/view", $company['id']); ?>" class="grey"><?php echo $company['name']; ?></a>
                </h5>
              </div>
              <?php if (!$company['owner']) : ?>
                <div class="columns auto">
                  <a class="grey" data-dropdown="#companyDrop_<?php echo $company['id']; ?>">
                    <i class="icon vertical ellipsis"></i>
                  </a>
                  <div class="wojo dropdown small pointing top-right" id="companyDrop_<?php echo $company['id']; ?>">
                    <!-- Start companyHistory -->
                    <a data-set='{"option":[{"action":"companyHistory","id":<?php echo $company['id']; ?>}], "label":"<?php echo Lang::$word->HISOCHGE; ?>", "url":"helper.php", "parent":"#cmp_<?php echo $company['id']; ?>", "complete":"replace", "modalclass":"normal", "buttons":false}' class="item action"><?php echo Lang::$word->HISOCHGE; ?></a>

                    <!-- Start archiveCompany -->
                    <a data-set='{"option":[{"archive": "archiveCompany","title": "<?php echo Validator::sanitize($company['name'], "chars"); ?>","id": "<?php echo $company['id']; ?>"}],"action":"archive","subtext":"<?php echo Lang::$word->MAC_SUB13; ?>", "parent":"#cmp_<?php echo $company['id']; ?>", "complete":"refresh"}' class="item data">
                      <?php echo Lang::$word->MTOARCHIVE; ?>
                    </a>
                    <div class="divider"></div>
                    <!-- Start trashCompany -->
                    <a data-set='{"option":[{"trash": "trashCompany","title": "<?php echo Validator::sanitize($company['name'], "chars"); ?>","id": "<?php echo $company['id']; ?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3; ?>", "parent":"#cmp_<?php echo $company['id']; ?>", "complete":"refresh"}' class="item wojo demi text data">
                      <?php echo Lang::$word->MTOTRASH; ?>
                    </a>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="content">
            <div class="wojo very relaxed fluid divided list">
              <?php foreach ($company['members'] as $i => $row) : ?>
                <?php if ($row['fullname']) : ?>
                  <div class="item align middle" id="item_<?php echo $row['uid']; ?>">
                    <div class="content auto center aligned">
                      <img src="<?php echo UPLOADURL; ?>/avatars/<?php echo $row['avatar'] ? $row['avatar'] : "blank.svg"; ?>" alt="" class="wojo avatar image">
                    </div>
                    <div class="content padding left">
                      <?php if ($row['userlevel'] <> 9) : ?>
                        <a class="wojo small simple top right attached icon button" data-dropdown="#userDrop_<?php echo $row['uid']; ?>">
                          <i class="icon fitted chevron down"></i>
                        </a>
                        <div class="wojo dropdown small pointing top-right" id="userDrop_<?php echo $row['uid']; ?>">
                          <?php if ($row['active'] != "t") : ?>
                            <!-- Start addtoProjects -->
                            <a data-set='{"option":[{"action":"addtoProjects","id": <?php echo $row['uid']; ?>}], "label":"<?php echo Lang::$word->ADDPROJECT; ?>", "url":"helper.php", "parent":"#item_<?php echo $row['uid']; ?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->ADDPROJECT; ?></a>

                            <!-- Start addtoTeam -->
                            <a data-set='{"option":[{"action":"addtoTeam","id": <?php echo $row['uid']; ?>}], "label":"<?php echo Lang::$word->ADDTEAM; ?>", "url":"helper.php", "parent":"#item_<?php echo $row['uid']; ?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->ADDTEAM; ?></a>
                          <?php endif; ?>

                          <!-- Start changeCompany -->
                          <a data-set='{"option":[{"action":"changeCompany","id": <?php echo $row['uid']; ?>,"url":"/admin/members"}], "label":"<?php echo Lang::$word->CHANGECMP; ?>", "url":"helper.php", "parent":"#item_<?php echo $row['uid']; ?>", "redirect":true, "modalclass":"normal"}' class="item action"><?php echo Lang::$word->CHANGECMP; ?></a>

                          <!-- Start archiveUser -->
                          <a data-set='{"option":[{"archive": "archiveUser","title": "<?php echo ($row['active'] == "t") ? $row['email'] : Validator::sanitize($row['fullname'], "chars"); ?>","id": "<?php echo $row['uid']; ?>"}],"action":"archive","subtext":"<?php echo Lang::$word->DELCONFIRM5; ?>", "parent":"#item_<?php echo $row['uid']; ?>"}' class="item data">
                            <?php echo Lang::$word->MTOARCHIVE; ?>
                          </a>
                          <div class="divider"></div>
                          <!-- Start trashUser -->
                          <a data-set='{"option":[{"trash": "trashUser","title": "<?php echo ($row['active'] == "t") ? $row['email'] : Validator::sanitize($row['fullname'], "chars"); ?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3; ?>", "parent":"#item_<?php echo $row['uid']; ?>"}' class="item wojo demi text data">
                            <?php echo Lang::$word->MTOTRASH; ?>
                          </a>
                        </div>
                      <?php endif; ?>
                      <div class="header">
                        <?php if ($row['active'] == "t") : ?>
                          <?php echo $row['email']; ?>
                        <?php else : ?>
                          <a href="<?php echo Url::url("/admin/members/details", $row['uid']); ?>" class="grey">
                            <?php echo $row['fullname']; ?>
                          </a>
                        <?php endif; ?>
                      </div>
                      <?php if ($row['active'] == "t") : ?>
                        <a onclick="$('#description').slideToggle(150)"><i class="icon chevron down"></i></a>
                        <div class="hide-all" id="description">
                          <div class="wojo small message">
                            <?php echo str_replace(array("[NAME]", "[TIME]"), array(Auth::$udata->name == $row['invite_by'] ? Lang::$word->YOU : $row['invite_by'], Date::timesince($row['invite_on'])), Lang::$word->MAC_INVITE_I); ?>
                            <!-- Start resendInvitation -->
                            <a data-set='{"option":[{"action":"resendInvitation","id": <?php echo $row['uid']; ?>}], "label":"<?php echo Lang::$word->MAC_RESEND; ?>", "url":"helper.php", "parent":"#item_<?php echo $row['uid']; ?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->MAC_RESEND; ?></a>
                            <div class="wojo vertical divider"></div>
                            <!-- Start copyInvitation -->
                            <a data-set='{"option":[{"action":"copyInvitation","id": <?php echo $row['uid']; ?>}], "label":"<?php echo Lang::$word->MAC_COPYLINK; ?>", "url":"helper.php", "parent":"#item_<?php echo $row['uid']; ?>", "complete":"highlite", "modalclass":"normal", "buttons":false}' class="item action"><?php echo Lang::$word->MAC_COPYLINK; ?></a>
                          </div>
                        </div>
                      <?php else : ?>
                        <div class="description">
                          <?php echo $row['email']; ?>
                        </div>
                      <?php endif; ?>
                      <div class="description"><?php echo Users::accountLevelToType($row['userlevel']); ?></div>
                    </div>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    <?php if ($this->data['ncmp']) : ?>
      <!-- Start users with no companies-->
      <div class="item">
        <div class="wojo attached card">
          <div class="header divided">
            <h5 class="basic"><?php echo Lang::$word->MAC_NOCMP; ?></h5>
          </div>
          <div class="content">
            <div class="wojo very relaxed fluid divided list">
              <?php foreach ($this->data['ncmp'] as $i => $row) : ?>
                <div class="item align middle" id="item_<?php echo $row->id; ?>">
                  <div class="content auto">
                    <img src="<?php echo UPLOADURL; ?>/avatars/<?php echo $row->avatar ? $row->avatar : "blank.svg"; ?>" alt="" class="wojo avatar image">
                  </div>
                  <div class="content padding left">
                    <a class="wojo small simple top right attached icon button" data-dropdown="#ncmpDrop_<?php echo $row->id; ?>">
                      <i class="icon fitted chevron down"></i>
                    </a>
                    <div class="wojo dropdown small pointing top-right" id="ncmpDrop_<?php echo $row->id; ?>">
                      <?php if ($row->active != "t") : ?>
                        <!-- Start addtoProjects -->
                        <a data-set='{"option":[{"action":"addtoProjects","id": <?php echo $row->id; ?>}], "label":"<?php echo Lang::$word->ADDPROJECT; ?>", "url":"helper.php", "parent":"#item_<?php echo $row->id; ?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->ADDPROJECT; ?></a>

                        <!-- Start addtoTeam -->
                        <a data-set='{"option":[{"action":"addtoTeam","id": <?php echo $row->id; ?>}], "label":"<?php echo Lang::$word->ADDTEAM; ?>", "url":"helper.php", "parent":"#item_<?php echo $row->id; ?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->ADDTEAM; ?></a>
                      <?php endif; ?>
                      <?php if ($row->userlevel <> 9) : ?>
                        <!-- Start changeCompany -->
                        <a data-set='{"option":[{"action":"changeCompany","id": <?php echo $row->id; ?>,"url":"/admin/members"}], "label":"<?php echo Lang::$word->CHANGECMP; ?>", "url":"helper.php", "parent":"#item_<?php echo $row->id; ?>", "redirect":true, "modalclass":"normal"}' class="item action"><?php echo Lang::$word->CHANGECMP; ?></a>

                        <!-- Start archiveUser -->
                        <a data-set='{"option":[{"archive": "archiveUser","title": "<?php echo Validator::sanitize($row->fullname, "chars"); ?>","id": "<?php echo $row->id; ?>"}],"action":"archive","subtext":"<?php echo Lang::$word->DELCONFIRM5; ?>", "parent":"#item_<?php echo $row->id; ?>"}' class="item data">
                          <?php echo Lang::$word->MTOARCHIVE; ?>
                        </a>
                        <div class="divider"></div>
                        <!-- Start trashUser -->
                        <a data-set='{"option":[{"trash": "trashUser","title": "<?php echo Validator::sanitize($row->fullname, "chars"); ?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3; ?>", "parent":"#item_<?php echo $row->id; ?>"}' class="item wojo demi text data">
                          <?php echo Lang::$word->MTOTRASH; ?>
                        </a>
                      <?php endif; ?>
                    </div>
                    <div class="header">
                      <?php if ($row->active == "t") : ?>
                        <?php echo $row->email; ?>
                      <?php else : ?>
                        <a href="<?php echo Url::url("/members/details", $row->id); ?>" class="grey">
                          <?php echo $row->fullname; ?>
                        </a>
                      <?php endif; ?>
                    </div>
                    <div class="description">
                      <?php if ($row->active == "t") : ?>
                        <?php echo str_replace(array("[NAME]", "[TIME]"), array($row->invite_by, Date::timesince($row->invite_on)), Lang::$word->MAC_INVITE_I); ?>
                        <!-- Start resendInvitation -->
                        <a data-set='{"option":[{"action":"resendInvitation","id": <?php echo $row->id; ?>}], "label":"<?php echo Lang::$word->MAC_RESEND; ?>", "url":"helper.php", "parent":"#item_<?php echo $row->id; ?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->MAC_RESEND; ?></a>

                        <!-- Start copyInvitation -->
                        <a data-set='{"option":[{"action":"copyInvitation","id":<?php echo $row->id; ?>}], "label":"<?php echo Lang::$word->MAC_COPYLINK; ?>", "url":"helper.php", "parent":"#item_<?php echo $row->id; ?>", "complete":"highlite", "modalclass":"normal", "buttons":false}' class="item action"><?php echo Lang::$word->MAC_COPYLINK; ?></a>
                      <?php else : ?>
                        <?php echo $row->email; ?>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>