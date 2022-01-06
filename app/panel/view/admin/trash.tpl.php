<?php
  /**
   * Trash
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: trash.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<div class="row align middle gutters">
  <div class="columns">
    <h3><?php echo Lang::$word->TRS_TITLE;?></h3>
    <p class="wojo small grey text"><?php echo Lang::$word->TRS_INFO;?></p>
  </div>
  <?php if($this->data):?>
  <div class="columns auto">
    <a data-set='{"option":[{"delete": "trashAll","title": "<?php echo Validator::sanitize(Lang::$word->TRS_TEMPTY, "chars");?>"}],"action":"delete", "parent":"#self","redirect":"<?php echo Url::url("/admin/trash");?>"}' class="wojo small negative button data">
    <?php echo Lang::$word->TRS_TEMPTY;?>
    </a>
  </div>
  <?php endif;?>
</div>
<?php if(!$this->data):?>
<div class="center aligned"><img src="<?php echo ADMINVIEW;?>/images/trash_empty.svg" alt="" class="wojo center big image">
  <p class="wojo semi grey text"><?php echo Lang::$word->TRS_NOTRS;?></p>
</div>
<?php else:?>
<?php foreach($this->data as $type => $rows):?>
<?php switch($type): ?>
<?php case "company":?>
<!-- company-->
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"><h5 class="basic"><?php echo Lang::$word->CMP_COMPANIES;?></h5></th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $company = Utility::jSonToArray($row->dataset);?>
  <tr id="company_<?php echo $row->id;?>">
    <td><?php echo $company->name;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreCompany","title": "<?php echo Validator::sanitize($company->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#company_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteCompany","title": "<?php echo Validator::sanitize($company->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#company_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($company);?>
</table>
<?php break;?>

<!-- user-->
<?php case "user":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic"><?php echo Lang::$word->USERS;?></h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $user = Utility::jSonToArray($row->dataset);?>
  <tr id="user_<?php echo $row->id;?>">
    <td><?php echo $user->fname ? $user->fname . ' ' . $user->lname : $user->email;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreUser","title": "<?php echo Validator::sanitize($user->fname ? $user->fname . ' ' . $user->lname : $user->email, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#user_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteUser","title": "<?php echo Validator::sanitize($user->fname ? $user->fname . ' ' . $user->lname : $user->email, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#user_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($user);?>
</table>
<?php break;?>

<!-- project-->
<?php case "project":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic">
          <?php echo Lang::$word->PRJ_PROJECTS;?>
        </h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $project = Utility::jSonToArray($row->dataset);?>
  <tr id="project_<?php echo $row->id;?>">
    <td><?php echo $project->name;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreProject","title": "<?php echo Validator::sanitize($project->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#project_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteProject","title": "<?php echo Validator::sanitize($project->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#project_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($project);?>
</table>
<?php break;?>

<!-- task-->
<?php case "task":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic">
          <?php echo Lang::$word->TSK_TASKS;?>
        </h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $task = Utility::jSonToArray($row->dataset);?>
  <tr id="task_<?php echo $row->id;?>">
    <td><?php echo $task->name;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreTaskAlt","title": "<?php echo Validator::sanitize($task->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#task_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteTask","title": "<?php echo Validator::sanitize($task->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#task_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($task);?>
</table>
<?php break;?>

<!-- trecord-->
<?php case "trecord":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic">
          <?php echo Lang::$word->INV_SUB5_1;?>
        </h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $trecord = Utility::jSonToArray($row->dataset);?>
  <tr id="trecord_<?php echo $row->id;?>">
    <td><?php echo $trecord->title;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreTrecord","title": "<?php echo Validator::sanitize($trecord->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#trecord_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteTrecord","title": "<?php echo Validator::sanitize($trecord->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#trecord_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($dataset);?>
</table>
<?php break;?>

<!-- execord-->
<?php case "execord":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic">
          <?php echo Lang::$word->INV_SUB5_2;?>
        </h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $execord = Utility::jSonToArray($row->dataset);?>
  <tr id="execord_<?php echo $row->id;?>">
    <td><?php echo $execord->title;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreErecord","title": "<?php echo Validator::sanitize($execord->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#execord_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteErecord","title": "<?php echo Validator::sanitize($execord->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#execord_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($dataset);?>
</table>
<?php break;?>

<!-- notes-->
<?php case "note":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"><h5 class="basic">
          <?php echo Lang::$word->NOT_NOTES;?>
        </h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $note = Utility::unserialToArray($row->dataset);?>
  <tr id="note_<?php echo $row->id;?>">
    <td><?php echo $note->name;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreNote","title": "<?php echo Validator::sanitize($note->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#note_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteNote","title": "<?php echo Validator::sanitize($note->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#note_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($note);?>
</table>
<?php break;?>

<!-- discussion-->
<?php case "discussion":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"><h5 class="basic">
          <?php echo Lang::$word->MSG_DISC;?>
        </h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $discussion = Utility::jSonToArray($row->dataset);?>
  <tr id="discussion_<?php echo $row->id;?>">
    <td><?php echo $discussion->name;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreDiscussion","title": "<?php echo Validator::sanitize($discussion->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#discussion_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteDiscussion","title": "<?php echo Validator::sanitize($discussion->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#discussion_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($discussion);?>
</table>
<?php break;?>

<!-- message-->
<?php case "message":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"><h5 class="basic">
          <?php echo Lang::$word->MSG_MSGS;?>
        </h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $message = Utility::jSonToArray($row->dataset);?>
  <tr id="message_<?php echo $row->id;?>">
    <td><?php echo $message->name;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreMessage","title": "<?php echo Validator::sanitize($message->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#message_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteMessage","title": "<?php echo Validator::sanitize($message->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#message_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($dataset, $rows, $row);?>
</table>
<?php break;?>

<!-- calendar-->
<?php case "calendar":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"><h5 class="basic"><?php echo Lang::$word->CAL_CALENDAR;?></h5></th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $calendar = Utility::jSonToArray($row->dataset);?>
  <tr id="calendar_<?php echo $row->id;?>">
    <td><?php echo $calendar->name;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreCalendar","title": "<?php echo Validator::sanitize($calendar->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#calendar_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteCalendar","title": "<?php echo Validator::sanitize($calendar->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#calendar_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($calendar);?>
</table>
<?php break;?>

<!-- event-->
<?php case "event":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"><h5 class="basic">
          <?php echo Lang::$word->CAL_CALENDAR;?>
        </h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $event = Utility::jSonToArray($row->dataset);?>
  <tr id="event_<?php echo $row->id;?>">
    <td><?php echo $event->name;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreEvent","title": "<?php echo Validator::sanitize($event->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#event_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteEvent","title": "<?php echo Validator::sanitize($event->name, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#event_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($event, $rows, $row);?>
</table>
<?php break;?>

<!-- invoice-->
<?php case "invoice":?>
<table class="wojo small segment table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic">
          <?php echo Lang::$word->INV_INVOICES;?>
        </h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $invoice = Utility::jSonToArray($row->dataset);?>
  <tr id="invoice_<?php echo $row->id;?>">
    <td><?php echo Content::invoiceID($invoice->id, $invoice->custom_id);?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreInvoice","title": "<?php echo Content::invoiceID($invoice->id, $invoice->custom_id);?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#invoice_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteInvoice","title": "<?php echo Content::invoiceID($invoice->id, $invoice->custom_id);?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#invoice_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($invoice);?>
</table>
<?php break;?>
<!-- estimate-->
<?php case "estimate":?>
<table class="wojo small table">
  <thead>
    <tr>
      <th colspan="2"> <h5 class="basic">
          <?php echo Lang::$word->EST_ESTIMATES;?>
        </h5>
      </th>
    </tr>
  </thead>
  <?php foreach($rows as $row):?>
  <?php $estimate = Utility::unserialToArray($row->dataset);?>
  <tr id="estimate_<?php echo $row->id;?>">
    <td><?php echo $estimate->title;?></td>
    <td class="auto"><div class="wojo mini buttons">
        <a data-set='{"option":[{"restore": "restoreEstimate","title": "<?php echo Validator::sanitize($estimate->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"restore","subtext":"<?php echo Lang::$word->DELCONFIRM11;?>", "parent":"#estimate_<?php echo $row->id;?>"}' class="wojo positive button data">
        <?php echo Lang::$word->RESTORE;?>
        </a>
        <a data-set='{"option":[{"delete": "deleteEstimate","title": "<?php echo Validator::sanitize($estimate->title, "chars");?>","id": "<?php echo $row->id;?>"}],"action":"delete", "parent":"#estimate_<?php echo $row->id;?>"}' class="wojo negative button data">
        <?php echo Lang::$word->TRS_DELGOOD;?>
        </a>
      </div></td>
  </tr>
  <?php endforeach;?>
  <?php unset($estimate);?>
</table>
<?php break;?>
<?php endswitch;?>
<?php endforeach;?>
<?php endif;?>