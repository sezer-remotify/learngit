<?php
/**
 * Company View
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _company_view.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
	die('Direct access to this location is not allowed.');
?>
<div class="wojo heading message">
  <div class="content">
    <h3><?php echo Lang::$word->CMP_COMPANY;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->CMP_INFO;?></p>
  </div>
</div>
<div class="wojo fitted segment">
  <div class="header">
    <div class="items"><img src="<?php echo UPLOADURL;?>/logos/<?php echo $this->row->logo ? $this->row->logo : 'blank.png';?>" alt="" class="wojo small image"></div>
    <div class="items">
      <h4 class="basic"><?php echo $this->row->name;?></h4>
      <p class="wojo small grey text"><?php echo Date::doDate("long_date", $this->row->created);?></p>
      <?php if($this->row->owner):?>
      <a href="<?php echo Url::url("/admin/companies/edit", $this->row->id);?>" class="wojo small primary inverted button"><?php echo Lang::$word->EDIT;?>
      </a>
      <?php else:?>
      <div class="wojo small buttons">
        <a href="<?php echo Url::url("/admin/companies/edit", $this->row->id);?>" class="wojo dark inverted button">
        <?php echo Lang::$word->CMP_EDIT;?>
        </a>
        <a class="wojo icon dark inverted button" data-dropdown="#companyDrop_<?php echo $this->row->id;?>">
        <i class="icon horizontal ellipsis"></i>
        </a>
      </div>
      <div class="wojo dropdown small pointing top-right" id="companyDrop_<?php echo $this->row->id;?>">
        <!-- Start companyHistory -->
        <a data-set='{"option":[{"action":"companyHistory","id":<?php echo $this->row->id;?>}], "label":"<?php echo Lang::$word->HISOCHGE;?>", "url":"helper.php", "parent":"#cmp_<?php echo $this->row->id;?>", "complete":"replace", "modalclass":"normal", "buttons":false}' class="item action"><?php echo Lang::$word->HISOCHGE;?></a>
        
        <!-- Start archiveCompany -->
        <a data-set='{"option":[{"archive": "archiveCompany","title": "<?php echo Validator::sanitize($this->row->name, "chars");?>","id": "<?php echo $this->row->id;?>"}],"action":"archive","subtext":"<?php echo Lang::$word->MAC_SUB13;?>", "parent":"#cmp_<?php echo $this->row->id;?>", "redirect":"<?php echo Url::url("/admin/members/");?>"}' class="item data">
        <?php echo Lang::$word->MTOARCHIVE;?>
        </a>
        <div class="divider"></div>
        <!-- Start trashCompany -->
        <a data-set='{"option":[{"trash": "trashCompany","title": "<?php echo Validator::sanitize($this->row->name, "chars");?>","id": "<?php echo $this->row->id;?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#cmp_<?php echo $this->row->id;?>", "redirect":"<?php echo Url::url("/admin/members/");?>"}' class="item wojo demi text data">
        <?php echo Lang::$word->MTOTRASH;?>
        </a>
      </div>
      <?php endif;?>
    </div>
  </div>
  <div class="content">
    <div class="wojo small celled items">
      <div class="item">
        <div class="columns two wide">
          <h6 class="basic"><?php echo Lang::$word->CMP_INFO;?>:</h6>
        </div>
        <div class="columns"><i class="icon building"></i>
          <?php echo $this->row->address;?>
          <?php echo $this->row->city;?>, <?php echo $this->row->state;?>, <?php echo $this->row->zip;?>
          &bull;
          <i class="icon phone"></i>
          <?php echo $this->row->phone;?>
          &bull;
          <i class="icon globe"></i>
          <?php echo $this->row->website;?></div>
      </div>
      <div class="item">
        <div class="columns two wide">
          <h6 class="basic"><?php echo Lang::$word->CFG_SCURRENCY_S;?>:</h6>
        </div>
        <div class="columns"><?php echo $currency = $this->row->currency ? $this->row->currency : $this->core->currency;?></div>
      </div>
      <?php if($this->row->jobtypes):?>
      <div class="item">
        <div class="columns two wide">
          <h6 class="basic"><?php echo Lang::$word->CMP_RATEC;?>:</h6>
        </div>
        <div class="columns">
          <?php foreach ($this->jobtypes as $rate):?>
          <?php echo $rate->name . ' (' . $rate->hrate . ' ' . $currency . ') ' . Lang::$word->PERHOUR . ' &bull;';?>
          <?php endforeach;?>
        </div>
      </div>
      <?php endif;?>
      <?php if($this->row->note):?>
      <div class="item">
        <div class="columns two wide">
          <h6 class="basic"><?php echo Lang::$word->CMP_NOTE;?>:</h6>
        </div>
        <div class="columns"><?php echo $this->row->note;?></div>
      </div>
      <?php endif;?>
    </div>
  </div>
</div>
<?php if($this->members):?>
<!-- Start Members Section -->
<div class="wojo card">
  <div class="header">
    <div class="wojo inverted rounded primary label">
      <?php echo count($this->members);?>
      <?php echo Lang::$word->USERS;?>
    </div>
  </div>
  <div class="wojo divided items">
    <?php foreach($this->members as $i => $row):?>
    <div class="item" id="item_<?php echo $row->id;?>">
      <div class="columns auto"><img src="<?php echo UPLOADURL;?>/avatars/<?php echo ($row->avatar) ? $row->avatar : "blank.svg ";?>" alt="" class="wojo category image"></div>
      <div class="columns">
        <?php if($row->active == "t"):?>
        <?php echo $row->email;?>
        <?php else:?>
        <a href="<?php echo Url::url("/admin/members/details", $row->id);?>">
        <?php echo $row->fullname;?>
        </a>
        <?php endif;?>
      </div>
      <div class="columns">
        <?php if($row->active == "t"):?>
        <div class="wojo note alert"><?php echo str_replace(array("[NAME]", "[TIME]"), array($row->invite_by, Date::timesince($row->invite_on)), Lang::$word->MAC_INVITE_I);?>
          <a class="dark" data-dropdown="#iuserDrop_<?php echo $row->id;?>">
          <i class="icon circle chevron down"></i>
          </a>
          <div class="wojo dropdown small pointing top-right" id="iuserDrop_<?php echo $row->id;?>">
            <!-- Start resendInvitation -->
            <a data-set='{"option":[{"action":"resendInvitation","id": <?php echo $row->id;?>}], "label":"<?php echo Lang::$word->MAC_RESEND;?>", "url":"helper.php", "parent":"#item_<?php echo $row->id;?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->MAC_RESEND;?></a>
            
            <!-- Start copyInvitation -->
            <a data-set='{"option":[{"action":"copyInvitation","id": <?php echo $row->id;?>}], "label":"<?php echo Lang::$word->MAC_COPYLINK;?>", "url":"helper.php", "parent":"#item_<?php echo $row->id;?>", "complete":"highlite", "modalclass":"normal", "buttons":false}' class="item action"><?php echo Lang::$word->MAC_COPYLINK;?></a>
          </div>
        </div>
        <?php else:?>
        <?php echo $row->email;?>
        <?php endif;?>
      </div>
      <div class="columns one wide">
        <?php echo Users::accountLevelToTypeLabel($row->userlevel);?>
      </div>
      <div class="columns auto">
        <?php if($row->userlevel <> 9):?>
        <a class="wojo small dark inverted icon button" data-dropdown="#userDrop_<?php echo $row->id;?>">
        <i class="icon vertical ellipsis"></i>
        </a>
        <div class="wojo dropdown small pointing top-right" id="userDrop_<?php echo $row->id;?>">
          <?php if($row->active != "t"):?>
          <!-- Start addtoProjects -->
          <a data-set='{"option":[{"action":"addtoProjects","id": <?php echo $row->id;?>}], "label":"<?php echo Lang::$word->ADDPROJECT;?>", "url":"helper.php", "parent":"#item_<?php echo $row->id;?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->ADDPROJECT;?></a>
          
          <!-- Start addtoTeam -->
          <a data-set='{"option":[{"action":"addtoTeam","id": <?php echo $row->id;?>}], "label":"<?php echo Lang::$word->ADDTEAM;?>", "url":"helper.php", "parent":"#item_<?php echo $row->id;?>", "complete":"highlite", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->ADDTEAM;?></a>
          <?php endif;?>
          
          <!-- Start changeCompany -->
          <a data-set='{"option":[{"action":"changeCompany","id": <?php echo $row->id;?>,"url":"/admin/companies/view/<?php echo $row->id;?>"}], "label":"<?php echo Lang::$word->CHANGECMP;?>", "url":"helper.php", "parent":"#item_<?php echo $row->id;?>", "redirect":true, "modalclass":"normal"}' class="item action"><?php echo Lang::$word->CHANGECMP;?></a>
          
          <!-- Start archiveUser -->
          <a data-set='{"option":[{"archive": "archiveUser","title": "<?php echo ($row->active == "t") ? $row->email : Validator::sanitize($row->fullname, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"archive","subtext":"<?php echo Lang::$word->DELCONFIRM5;?>", "parent":"#item_<?php echo $row->id;?>"}' class="item data">
          <?php echo Lang::$word->MTOARCHIVE;?>
          </a>
          <div class="divider"></div>
          <!-- Start trashUser -->
          <a data-set='{"option":[{"trash": "trashUser","title": "<?php echo ($row->active == "t") ? $row->email : Validator::sanitize($row->fullname, "chars");?>"}],"action":"trash","subtext":"<?php echo Lang::$word->DELCONFIRM3;?>", "parent":"#item_<?php echo $row->id;?>"}' class="item wojo demi text data">
          <?php echo Lang::$word->MTOTRASH;?>
          </a>
        </div>
        <?php endif;?>
      </div>
    </div>
    <?php endforeach;?>
    <?php unset($row);?>
  </div>
</div>
<?php endif;?>
<?php if($this->projects):?>
<!-- Start Project Section -->
<div class="wojo card">
  <div class="header">
    <div class="wojo inverted rounded primary label">
      <?php echo count($this->projects);?>
      <?php echo Lang::$word->PRJ_PROJECTS;?>
    </div>
  </div>
  <div class="wojo divided items">
    <?php foreach($this->projects as $i => $row):?>
    <div class="item" id="item_<?php echo $row->id;?>">
      <div class="columns">
        <a href="<?php echo Url::url("/admin/projects/edit", $row->id);?>">
        <?php echo $row->name;?>
        </a>
      </div>
      <div class="columns auto">
        <span class="wojo small bold text">
        <?php echo Date::timeSince($row->created);?>
        </span>
      </div>
    </div>
    <?php unset($row);?>
    <?php endforeach;?>
  </div>
</div>
<?php endif;?>
<?php if($this->invoices):?>
<!-- Start Invoice Section -->
<div class="wojo card">
  <div class="header">
    <div class="wojo inverted rounded primary label">
      <?php echo count($this->invoices);?>
      <?php echo Lang::$word->INV_INVOICES;?>
    </div>
  </div>
  <table class="wojo small basic responsive table">
    <thead>
      <tr>
        <th>ID</th>
        <th> <?php echo Lang::$word->INV_DUED;?> </th>
        <th> <?php echo Lang::$word->INV_AMOUNT;?> </th>
        <th> <?php echo Lang::$word->INV_OWNING;?> </th>
        <th> <?php echo Lang::$word->STATUS;?> </th>
        <th class="auto"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($this->invoices as $i => $row):?>
      <tr id="ivitemu_<?php echo $row->id;?>">
        <td><a href="<?php echo Url::url("/admin/invoices/view", $row->id);?>" class="wojo tiny bold text">
          <?php echo Content::invoiceID($row->id, $row->custom_id);?>
          </a></td>
        <td><?php echo Date::doDate("short_date", $row->due_date);?></td>
        <td><?php echo Utility::formatMoney($row->total, $row->currency);?></td>
        <td><?php echo Utility::formatMoney(($row->balance_due - $row->paid_amount), $row->currency);?></td>
        <td><?php echo Project::invoiceStatus($row->status);?>
          <?php echo Project::invoicepStatus($row->pstatus);?></td>
        <td><a class="wojo small dark inverted icon button" data-dropdown="#invoiceDrop_<?php echo $row->id;?>">
          <i class="icon vertical ellipsis"></i>
          </a>
          <div class="wojo dropdown small pointing top-right" id="invoiceDrop_<?php echo $row->id;?>">
            <!-- Start editInvoice -->
            <?php if(Auth::hasPrivileges('edit_invoice') and $row->pstatus <> 2):?>
            <a href="<?php echo Url::url("/admin/invoices/edit", $row->id);?>" class="item">
            <?php echo Lang::$word->EDIT;?>
            </a>
            <?php endif;?>
            
            <!-- Start duplicateInvoice -->
            <?php if($row->recurring == 0):?>
            <a href="<?php echo Url::url("/admin/invoices/duplicate", $row->id);?>" class="item">
            <?php echo Lang::$word->DUPLICATE;?>
            </a>
            <?php endif;?>
            
            <!-- Start markAsSent -->
            <?php if($row->status == 0):?>
          <a data-set='{"option":[{"action":"invoiceMarkSent","id":<?php echo $row->id;?>, "tpl":"loadIvSingleCompany"}], "label":"<?php echo Lang::$word->INV_MASEND;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_MASEND;?></a>
            <?php endif;?>
            
            <!-- Start disableReminders -->
            <?php if($row->pstatus <> 2):?>
          <a id="act_<?php echo $row->id;?>" data-set='{"option":[{"action":"invoiceReminder","id":<?php echo $row->id;?>}], "label":"<?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?>", "url":"helper.php", "parent":"#act_<?php echo $row->id;?>", "complete":"replaceWith", "modalclass":"normal"}' class="item action"><?php echo $row->reminder ? Lang::$word->INV_DISREM : Lang::$word->INV_ENREM;?></a>
            <?php endif;?>
            
            <!-- Start sendEmail -->
          <a data-set='{"option":[{"action":"sendInvoice","id":<?php echo $row->id;?>, "tpl":"loadIvSingleCompany"}], "label":"<?php echo Lang::$word->INV_SENDIV;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_SENDIVE;?></a>
            
            <!-- Start invoicePayment -->
            <?php if($row->pstatus <> 2):?>
          <a data-set='{"option":[{"action":"invoiceAddPayment","id":<?php echo $row->id;?>, "url":"<?php echo Url::uri();?>"}], "label":"<?php echo Lang::$word->INV_ADDPAY;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "redirect":true, "complete":"replace", "modalclass":"normal"}' class="item action"><?php echo Lang::$word->INV_ADDPAY;?></a>
            <?php endif;?>
            
            <div class="divider"></div>
            <!-- Start downloadPdf -->
            <a class="item" href="<?php echo ADMINVIEW;?>/helper.php?action=downloadInvoice&amp;id=<?php echo $row->id;?>">
            <?php echo Lang::$word->INV_DPDF;?>
            </a>
            
            <!-- Start invoiceAccess -->
          <a data-set='{"option":[{"action":"invoiceAccess","id":<?php echo $row->id;?>}], "label":"<?php echo Lang::$word->INV_ACCESS;?>", "url":"helper.php", "parent":"#ivitemu_<?php echo $row->id;?>", "complete":"highlite", "modalclass":"normal","buttons":false}' class="item action"><?php echo Lang::$word->INV_ACCESS;?></a>
            <div class="divider"></div>
            <!-- Start archiveInvoice -->
          <a data-set='{"option":[{"archive": "archiveInvoice","title": "<?php echo Content::invoiceID($row->id, $row->custom_id);?>","id": "<?php echo $row->id;?>"}],"action":"archive","subtext":"<?php echo Lang::$word->INV_CANCEL_I;?>", "parent":"#ivitemu_<?php echo $row->id;?>"}' class="wojo demi text item data">
          <?php echo Lang::$word->INV_CINV;?>
          </a>
          </div></td>
      </tr>
      <?php endforeach;?>
    </tbody>
  </table>
</div>
<?php endif;?>