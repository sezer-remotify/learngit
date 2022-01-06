<?php

/**
 * Members
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _members_list.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<div style="display:none">
  <pre>
      <?php print_r($this->data['hcmp'])?>
  </pre>
</div>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->PEOPLE; ?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->MAC_INFO; ?></p>
  </div>
</div>
<div class="row gutters align bottom">
  <div class="columns phone-100">
    <div class="wojo small white stacked buttons">
      <a href="<?php echo Url::url(Router::$path, "invite"); ?>" class="wojo button"><?php echo Lang::$word->MAC_INVPEOPLE; ?></a>
      <a href="<?php echo Url::url("/admin/companies", "new"); ?>" class="wojo button"><?php echo Lang::$word->CMP_NEW; ?></a>
      <a href="<?php echo Url::url("/admin/teams"); ?>" class="wojo button"><?php echo Lang::$word->TMS_TEAMS; ?></a>
      <a href="<?php echo Url::url("/admin/members", "archive"); ?>" class="wojo button"><?php echo Lang::$word->ARCHIVE; ?></a>
      <a href="<?php echo Url::url("/admin/members", "freelancers"); ?>" class="wojo button"><?php echo Lang::$word->FREELANCERS; ?></a>
    </div>
  </div>
  <div class="columns auto phone-100">
    <a class="wojo small basic disabled icon button"><i class="icon reorder"></i></a>
    <a href="<?php echo Url::url(Router::$path, "grid"); ?>" class="wojo small primary icon button"><i class="icon grid"></i></a>
  </div>
</div>
<div class="wojo segment form">
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
          <button class="wojo icon primary inverted button"><i class="icon find"></i></button>
        </div>
      </div>
    </div>
  </form>
  <div class="center aligned"><?php echo Validator::alphaBits(Url::url(Router::$path), "letter", "wojo small horizontal link divided list align center"); ?></div>
</div>
<?php if (isset($this->data['hcmp'])) : ?>
  <!-- Start users with companies-->
  <?php foreach ($this->data['hcmp'] as $company) : ?>
    <div class="wojo fitted gutters segment" id="cmp_<?php echo $company['id']; ?>">
      <div class="header divided align middle">
        <div class="items">
          <?php if (!$company['owner']) : ?>
            <a data-dropdown="#companyDrop_<?php echo $company['id']; ?>" class="grey">
              <i class="icon chevron down"></i>
            </a>
            <div class="wojo dropdown small pointing top-left" id="companyDrop_<?php echo $company['id']; ?>">
              <!-- Start companyHistory -->
              <a data-set='{"option":[{"action":"companyHistory","id":<?php echo $company['id']; ?>}], "label":"<?php echo Lang::$word->HISOCHGE; ?>", "url":"helper.php", "parent":"#cmp_<?php echo $company['id']; ?>", "complete":"replace", "modalclass":"normal", "buttons":false}' class="item action"><?php echo Lang::$word->HISOCHGE; ?></a>

              <!-- Start archiveCompany -->
              <a data-set='{"option":[{"archive": "archiveCompany","title": "<?php echo Validator::sanitize($company['name'], "chars"); ?>","id": "<?php echo $company['id']; ?>"}],"action":"archive","subtext":"<?php echo Lang::$word->MAC_SUB13; ?>", "parent":"#cmp_<?php echo $company['id']; ?>"}' class="item data">
                <?php echo Lang::$word->MTOARCHIVE; ?>
              </a>
              <div class="divider"></div>
              <!-- Start trashCompany -->
              <a data-set='{"option":[{"trash": "trashCompany","title": "<?php echo Validator::sanitize($company['name'], "chars"); ?>","id": "<?php echo $company['id']; ?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3; ?>", "parent":"#cmp_<?php echo $company['id']; ?>"}' class="item wojo demi text data">
                <?php echo Lang::$word->MTOTRASH; ?>
              </a>
            </div>
          <?php else : ?>
            <i class="icon delete"></i>
          <?php endif; ?>
        </div>
        <div class="items">
          <h4 class="basic">
            <a href="<?php echo Url::url("/admin/companies/view", $company['id']); ?>" class="grey"><?php echo $company['name']; ?></a>
          </h4>
        </div>
      </div>
      <div class="wojo divided items">
        <?php foreach ($company['members'] as $i => $row) : ?>
          <?php if ($row['fullname']) : ?>
            <?php $color = Utility::getColors(); ?>
            <div class="item" id="item_<?php echo $row['uid']; ?>">
              <div class="columns auto">
                <?php if ($row['avatar']) : ?>
                  <img src="<?php echo UPLOADURL; ?>/avatars/<?php echo $row['avatar']; ?>" alt="" class="wojo category image">
                <?php else : ?>
                  <span style="background-color:<?php echo $color; ?>;color:#fff;border-color:<?php echo $color; ?>;" class="wojo initials circular label"><?php echo Utility::getInitials($row['fullname']); ?></span>
                <?php endif; ?>
              </div>
              <div class="columns four wide">
                <?php if ($row['active'] == "t") : ?>
                  <?php echo $row['email']; ?>
                <?php else : ?>
                  <a href="<?php echo Url::url("/admin/members/details", $row['uid']); ?>">
                    <?php echo $row['fullname']; ?>
                  </a>
                <?php endif; ?>
              </div>
              <div class="columns">
                <?php if ($row['active'] == "t") : ?>
                  <div class="wojo note alert"><?php echo str_replace(array("[NAME]", "[TIME]"), array(Auth::$udata->name == $row['invite_by'] ? Lang::$word->YOU : $row['invite_by'], Date::timesince($row['invite_on'])), Lang::$word->MAC_INVITE_I); ?>&nbsp;&nbsp;
                    <a class="dark" data-dropdown="#userDrop_<?php echo $row['uid']; ?>">
                      <i class="icon circle chevron down"></i>
                    </a>
                    <div class="wojo dropdown small pointing top-right" id="userDrop_<?php echo $row['uid']; ?>">
                      <!-- Start resendInvitation -->
                      <a data-set='{"option":[{"action":"resendInvitation","id": <?php echo $row['uid']; ?>}], "label":"<?php echo Lang::$word->MAC_RESEND; ?>", "url":"helper.php", "parent":"#item_<?php echo $row['uid']; ?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->MAC_RESEND; ?></a>

                      <!-- Start copyInvitation -->
                      <a data-set='{"option":[{"action":"copyInvitation","id": <?php echo $row['uid']; ?>}], "label":"<?php echo Lang::$word->MAC_COPYLINK; ?>", "url":"helper.php", "parent":"#item_<?php echo $row['uid']; ?>", "complete":"highlite", "modalclass":"normal", "buttons":false}' class="item action"><?php echo Lang::$word->MAC_COPYLINK; ?></a>
                    </div>
                  </div>
                <?php else : ?>
                  <?php echo $row['email']; ?>
                <?php endif; ?>
              </div>
              <div class="columns two wide"><?php echo Users::accountLevelToTypeLabel($row['userlevel']); ?></div>
              <div class="columns auto">
                <?php if ($row['userlevel'] <> 9) : ?>
                  <a class="grey" data-dropdown="#userDrop_<?php echo $row['uid']; ?>">
                    <i class="icon vertical ellipsis"></i>
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
              </div>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>
<?php if ($this->data['ncmp']) : ?>
  <!-- Start users with no companies-->
  <div class="wojo card">
    <div class="header divided">
      <div class="items">
        <h4 class="basic"><?php echo Lang::$word->MAC_NOCMP; ?></h4>
      </div>
    </div>
    <div class="wojo divided items">
      <?php foreach ($this->data['ncmp'] as $i => $row) : ?>
        <div class="item" id="item_<?php echo $row->id; ?>">
          <div class="columns auto">
            <?php if ($row->avatar) : ?>
              <img src="<?php echo UPLOADURL; ?>/avatars/<?php echo $row->avatar; ?>" alt="" class="wojo category image">
            <?php else : ?>
              <span class="wojo initials circular label"><?php echo ($row->fullname) ? Utility::getInitials($row->fullname) : '<i class="icon wojologo"></i>'; ?></span>
            <?php endif; ?>
          </div>
          <div class="columns two wide">
            <?php if ($row->active == "t") : ?>
              <?php echo $row->email; ?>
            <?php else : ?>
              <a href="<?php echo Url::url("/admin/members/details", $row->id); ?>">
                <?php echo $row->fullname; ?>
              </a>
            <?php endif; ?>
          </div>
          <div class="columns">
            <?php if ($row->active == "t") : ?>
              <div class="wojo note alert"><?php echo str_replace(array("[NAME]", "[TIME]"), array($row->invite_by, Date::timesince($row->invite_on)), Lang::$word->MAC_INVITE_I); ?>
                <a class="dark" data-dropdown="#userDrop_<?php echo $row->id; ?>">
                  <i class="icon circle chevron down"></i>
                </a>
                <div class="wojo dropdown small pointing top-right" id="userDrop_<?php echo $row->id; ?>">
                  <!-- Start resendInvitation -->
                  <a data-set='{"option":[{"action":"resendInvitation","id": <?php echo $row->id; ?>}], "label":"<?php echo Lang::$word->MAC_RESEND; ?>", "url":"helper.php", "parent":"#item_<?php echo $row->id; ?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->MAC_RESEND; ?></a>

                  <!-- Start copyInvitation -->
                  <a data-set='{"option":[{"action":"copyInvitation","id": <?php echo $row->id; ?>}], "label":"<?php echo Lang::$word->MAC_COPYLINK; ?>", "url":"helper.php", "parent":"#item_<?php echo $row->id; ?>", "complete":"highlite", "modalclass":"normal", "buttons":false}' class="item action"><?php echo Lang::$word->MAC_COPYLINK; ?></a>
                </div>
              </div>
            <?php else : ?>
              <?php echo $row->email; ?>
            <?php endif; ?>
          </div>
          <div class="columns two wide"><?php echo Users::accountLevelToType($row->userlevel); ?></div>
          <div class="columns auto"><a class="grey" data-dropdown="#ncmpDrop_<?php echo $row->id; ?>">
              <i class="icon vertical ellipsis"></i>
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
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>
