<?php

/**
 * Expenses
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: expenses.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');

if (!Auth::hasPrivileges('manage_people')) : print Message::msgError(Lang::$word->NOACCESS);
  return;
endif;
?>

<link href="<?php echo MASTERVIEW; ?>/css/dashboard.css" rel="stylesheet" type="text/css">
<link href="<?php echo MASTERVIEW; ?>/css/blue.css" rel="stylesheet" type="text/css">
<!-- Titlebar
================================================== -->
<div class="single-page-header freelancer-header margin-0" data-background-image="images/single-freelancer.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="single-page-header-inner row">
          <div class="left-side col-xl-6">
            <div class="header-image freelancer-avatar"><img src="<?php echo UPLOADURL; ?>/avatars/<?php echo ($this->row->avatar) ? $this->row->avatar : "blank.svg"; ?>" alt=""></div>
            <div class="header-details">
              <div>
                <h3 id="name" class="margin-0">
                  <?php echo $this->row->fname . ' ' . $this->row->lname; ?>
                </h3>
              </div>
              <div>
                <h3 class="margin-0"><span><?php echo $this->row->headline; ?></span></h3>
              </div>
              <div>
                <h4><span><?php echo Lang::$word->LOOKING_FOR; ?>: </span><span id="looking_for"><?php echo $this->row->emp_prefer; ?></span></h4>
              </div>
              <ul class="margin-bottom-20">
                <?php if ($this->row->country) : ?>
                  <li>
                    <img class="flag" src="<?php echo UPLOADURL; ?>/flags/<?php echo strtolower($this->row->country) . ".svg"; ?>" alt="<?php echo strtolower($this->row->country); ?>">
                    <?php foreach ($this->countries as $v) : ?>
                      <?php if ($v->iso_alpha2 === $this->row->country) echo $v->name; ?>
                    <?php endforeach; ?>
                  </li>
                <?php endif; ?>
                <li>
                  <div class="verified-badge-with-title"><?php echo Lang::$word->VERIFIED; ?></div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-xl-6 padding-top-15">
            <!-- Profile Overview -->
            <div class="profile-overview">
              <div class="overview-item text-center"><strong id="hourly_rate"><i class="icon-line-awesome-turkish-lira" style="font-weight: bold;"></i><?php echo $this->row->hourly_rate; ?></strong><span><?php echo Lang::$word->REP_SUB31; ?></span></div>
              <div class="overview-item text-center"><strong id="weekly_avail_hrs"><?php echo $this->row->available_hour; ?></strong><span><?php echo Lang::$word->WEEKLY_AVAIL; ?></span></div>
              <div class="overview-item text-center"><strong id="experience"><?php echo $this->row->experience; ?></strong><span><?php echo Lang::$word->EXP_LEVEL; ?></span></div>
              <!-- <div class="overview-item"><strong>53</strong><span>Jobs Done</span></div> -->
              <!-- <div class="overview-item"><strong>22</strong><span>Rehired</span></div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Page Content
================================================== -->
<div class="container dashboard-container padding-top-40" style="height:auto">
  <div class="row width-100">

    <!-- Content -->
    <div class="col-xl-8 col-lg-8 content-right-offset">

      <!-- About Me Section -->
      <div class="single-page-section">
        <h3 class="margin-bottom-25 font-weight-700"><?php echo Lang::$word->ABOUT_ME; ?></h3>
        <div id="about">
          <?php echo $this->row->about; ?>
        </div>
      </div>
	
		 <!-- Short CV Section -->
      <div class="single-page-section " style="position:relative;">
        <h3 class="margin-bottom-25 font-weight-700"><?php echo Lang::$word->SHORT_CV; ?></h3>
        <span class="editButton" id="shortCV">[edit]</span>
            <div id="CVshow">
              <?php echo $this->row->short_CV ?>
            </div>
        <div id="CVedit" style="display:none">
          <form method="post" id="shortCVForm" name="wojo_form">
            <input type="hidden" value="<?php echo $this->row->id?>" name="id">
                <textarea class="small" name="shortCV" placeholder="Short CV Information..."><?php echo $this->row->short_CV ?></textarea>
            <button type="button" data-action="updateShortCV" name="dosubmit" class="wojo small primary button"><?php echo Lang::$word->SAVE;?></button>
          </form>
        </div>
      </div>
      	 <!-- Reference and Note Section -->
	    <div class="row">
        <div class="single-page-section col-md-6" style="position:relative;">
            <h3 class="margin-bottom-25 font-weight-700"><?php echo Lang::$word->REF_CHK; ?></h3>
            <span class="editButton" id="referenceCheck">[edit]</span>
                <div id="referenceShow">
                  <?php echo $this->row->referenceCheck ?>
                </div>
            <div id="referenceEdit" style="display:none">
              <form method="post" id="referenceCheckForm" name="wojo_form">
                <input type="hidden" value="<?php echo $this->row->id?>" name="id">
                    <textarea class="small" name="referenceCheck" placeholder="Reference check informations..."><?php echo $this->row->referenceCheck ?></textarea>
                <button type="button" data-action="updateReferenceCheck" name="dosubmit" class="wojo small primary button"><?php echo Lang::$word->SAVE;?></button>
              </form>
            </div>
        </div>
        <div class="single-page-section col-md-6" style="position:relative;">
                <h3 class="margin-bottom-25 font-weight-700"><?php echo Lang::$word->NOT_NOTES; ?></h3>
                <span class="editButton" id="userNote">[edit]</span>
                    <div id="noteShow">
                      <?php echo $this->row->note; ?>
                    </div>
                <div id="noteEdit" style="display:none">
                <form method="post" id="NoteForm" name="wojo_form">
                  <input type="hidden" value="<?php echo $this->row->id?>" name="id">
                      <textarea class="small" name="note" placeholder="Notes..."><?php echo $this->row->note ?></textarea>
                  <button type="button" data-action="addUserNotesAtPage" name="dosubmit" class="wojo small primary button"><?php echo Lang::$word->SAVE;?></button>
                </form>
              </div>
        </div>
	    </div>
        <!--Projects Section -->
      <div class="single-page-section">
        <h3 class="margin-bottom-25 font-weight-700"><?php echo Lang::$word->ABOUT_ME; ?></h3>
        <div id="projectDetails">
          <table>
            <thead>
              <th colspan="4" style="padding-right:20px"><h4>Total Project Count</h4></th>
              <th colspan="4"><h4>Active Project Count</h4></th>
            <thead>
            <tbody>
              <td colspan="4"><h4><?php echo count($this->projects); ?></h4></td>
              <td colspan="4"><h4><?php $count = 0;foreach($this->projects as $pc){
                if($pc->status==1) $count++;
              } echo $count;?></h4></td>
            </tbody>              
          </table>
        </div>
        <div id="projects">
        <?php foreach ($this->projects as $p) : ?>
            <div class="row freelancerProjects">
              <div class="col-md-3">
              <a href="<?php echo Url::url("/admin/projects/tasks", $p->id);?>"><h5><?php echo $p->name; ?></h5></a>
              </div>
              <div class="col-md-2">
                <?php 
                  switch($p->status){
                    case 1:
                      echo '<h6><span class="badge badge-success">Active</span></h6>';
                    break;
                    case 2:
                      echo '<h6><span class="badge badge-danger">Trash</span></h6>';
                    break;
                    case 1:
                      echo '<h6><span class="badge badge-warning">Archive</span></h6>';
                    break;
                    case 1:
                      echo '<h6><span class="badge badge-primary">Completed</span></h6>';
                    break;
                  }
                ?>
              </div>
              <div class="col-md-3">
                <h6><?php echo $p->leader_name; ?></h6>
              </div>
              <div class="col-md-3">
                <h6><?php echo $p->start_date; ?></h6>
              </div>
        <?php endforeach; ?>
        </div>
      </div>
      </div>
      <!-- Attachment Section / Start -->
      <div class="boxed-list margin-bottom-60">
        <div class="boxed-list-headline">
          <h3><i class="icon-material-outline-description"></i><?php echo Lang::$word->ATTACHMENTS; ?></h3>
        </div>
        <ul id="publications-list" class="boxed-list-ul">
          <li>
            <!-- Attachments Widget -->
            <div class="sidebar-widget">
              <div class="attachments-container">
                <a target="_BLANK" href="<?php echo UPLOADURL . "/files/" . $this->row->cv; ?>" class="attachment-box ripple-effect"><span><?php echo Lang::$word->CV; ?></span><i>PDF</i></a>
                <!-- <a href="#" class="attachment-box ripple-effect"><span><?php echo Lang::$word->CONTRACT; ?></span><i>DOCX</i></a> -->
              </div>
            </div>
          </li>
        </ul>
      </div>


    </div>


    <!-- Sidebar -->
    <div class="col-xl-4 col-lg-4">
      <div class="sidebar-container">

		
		 <!-- Skills Widget -->
        <div class="sidebar-widget">
          <h3 class=" font-weight-700"><?php echo Lang::$word->APPR; ?></h3>
		  <span class="editButton" id="apprNote">[edit]</span>
          <div id="apprShow">
				<?php 
				switch ($this->row->approvalStatus ) {
					case "Approved":
						echo '<h4><span class="badge badge-success">'.$this->row->approvalStatus.'</span></h4>';
						$k=1;
						break;
					case "Not Approved":
						echo '<h4><span class="badge badge-secondary">'.$this->row->approvalStatus.'</span></h4>';
						$k=2;
						break;
					case "Penalized":
						echo '<h4><span class="badge badge-danger">'.$this->row->approvalStatus.'</span></h4>';
						$k=3;
						break;
					case "Not Sure":
						echo '<h4><span class="badge badge-primary">'.$this->row->approvalStatus.'</span></h4>';
						$k=4;
						break;
					case "On Hold":
						echo '<h4><span class="badge badge-warning">'.$this->row->approvalStatus.'</span></h4>';
						$k=5;
						break;
					case "Other":
						echo '<h4><span class="badge badge-info">'.$this->row->approvalStatus.'</span></h4>';
						$k=6;
						break;
				}
				?>
          </div>
		  <div id="apprEdit" style="display:none">
			<form method="post" id="apporvalForm" name="wojo_form">
				  <input type="hidden" value="<?php echo $this->row->id?>" name="id">
					 <select name="approvalStatus">
					  <option value="Approved" <?php if($k==1) echo "selected"?> >Approved</option>
					  <option value="Not Approved" <?php if($k==2) echo "selected"?> >Not Approved</option>
					  <option value="Penalized" <?php if($k==3) echo "selected"?> >Penalized</option>
					  <option value="Not Sure" <?php if($k==4) echo "selected"?> >Not Sure</option>
					  <option value="On Hold" <?php if($k==5) echo "selected"?> >On Hold</option>
					  <option value="Other" <?php if($k==6) echo "selected"?> >Other</option>
					</select>
				  <button type="button" data-action="approvalStatus" name="dosubmit" class="wojo small primary button"><?php echo Lang::$word->SAVE;?></button>
			 </form>
        </div>
        </div>
		
        <!-- Skills Widget -->
        <div class="sidebar-widget">
          <h3 class=" font-weight-700"><?php echo Lang::$word->SKILLS; ?></h3>
          <div class="task-tags">
            <?php foreach ($this->skills as $v) : ?>
              <span> <?php echo $v->name; ?></span>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Languages Widget -->
        <div class="sidebar-widget">
          <h3 class=" font-weight-700"><?php echo Lang::$word->LANGUAGES; ?></h3>
          <div class="task-tags">
            <?php foreach ($this->languages as $v) : ?>
              <span> <?php echo $v->name; ?></span>
            <?php endforeach; ?>
          </div>
        </div>
		
		 <!--Confirmed Skills Widget -->
        <div class="sidebar-widget">
          <h3 class=" font-weight-700"><?php echo Lang::$word->CONF_SKILLS; ?></h3>
          <div class="task-tags">
		  <form method="post" id="wojo_form" name="wojo_form">
		  <input type="hidden" value="<?php echo $this->row->id?>" name="id">
            <?php foreach ($this->skills as $v) : ?>
					
				  <label for="skill-<?php echo $v->sid;?>"><input type="checkbox" value="<? echo $v->id ?>" name="confirmSkill[]" id="skill-<?php echo $v->id; ?>" <?php if($v->confirmed != 0) echo "checked";?>> <?php echo $v->name;?></label>
            <?php endforeach; ?>
			 <button type="button" data-action="processSkillConfirm" name="dosubmit" class="wojo small primary button"><?php echo Lang::$word->SAVE;?></button>
			 
			</form>
          </div>
        </div>

		
      </div>
    </div>

  </div>
</div>

<!-- Make an Offer Popup / End -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
<script>
  tippy('#payment-verified', {
    content: "Payment Verified!",
  });
  tippy('#preferred-freelancer', {
    content: "Preferred Freelancer!",
  });
  tippy('#email-verified', {
    content: "Email Address Verified!",
  });
  tippy('#profile-verified', {
    content: "Profile Completed!",
  });
  tippy('#phone-verified', {
    content: "Phone Number Verified!",
  });
  tippy('#facebook-connected', {
    content: "Facebook Connected!",
  });
  $(document).ready(function() {
    $('#payment-verified').hover(function() {
      $('#payment-verified').toggleClass("custom-icon-active");
    });
    $('#preferred-freelancer').hover(function() {
      $('#preferred-freelancer').toggleClass("custom-icon-active");
    });
    $('#email-verified').hover(function() {
      $('#email-verified').toggleClass("custom-icon-active");
    });
    $('#profile-verified').hover(function() {
      $('#profile-verified').toggleClass("custom-icon-active");
    });
    $('#phone-verified').hover(function() {
      $('#phone-verified').toggleClass("custom-icon-active");
    });
    $('#facebook-connected').hover(function() {
      $('#facebook-connected').toggleClass("custom-icon-active");
    });
  });
  var editOn = 0;
  var referenceOn = 0;
  var noteOn = 0;
  var apprOn = 0;
  $("#shortCV").click(function(){
	  if(editOn== 0)
	  {
		$("#CVshow").toggle("slide", {"direction": "up"}, function(){
		   $("#CVedit").toggle("slide", {"direction": "up"});
		   editOn = 1;
		   $("#shortCV").empty();
		   $("#shortCV").append("[close]");
	   });
	  }else
	  {
		  $("#CVedit").toggle("slide", {"direction": "up"}, function(){
		   $("#CVshow").toggle("slide", {"direction": "up"});
		   editOn = 0;
		   $("#shortCV").empty();
		   $("#shortCV").append("[edit]");
	   });
	  }
 
  });
   $("#referenceCheck").click(function(){
	  if(referenceOn== 0)
	  {
		$("#referenceShow").toggle("slide", {"direction": "up"}, function(){
		   $("#referenceEdit").toggle("slide", {"direction": "up"});
		   referenceOn = 1;
		   $("#referenceCheck").empty();
		   $("#referenceCheck").append("[close]");
	   });
	  }else
	  {
		  $("#referenceEdit").toggle("slide", {"direction": "up"}, function(){
		   $("#referenceShow").toggle("slide", {"direction": "up"});
		   referenceOn = 0;
		   $("#referenceCheck").empty();
		   $("#referenceCheck").append("[edit]");
	   });
	  }
 
  });
   $("#userNote").click(function(){
	  if(noteOn== 0)
	  {
		$("#noteShow").toggle("slide", {"direction": "up"}, function(){
		   $("#noteEdit").toggle("slide", {"direction": "up"});
		   noteOn = 1;
		   $("#userNote").empty();
		   $("#userNote").append("[close]");
	   });
	  }else
	  {
		  $("#noteEdit").toggle("slide", {"direction": "up"}, function(){
		   $("#noteShow").toggle("slide", {"direction": "up"});
		   noteOn = 0;
		   $("#userNote").empty();
		   $("#userNote").append("[edit]");
	   });
	  }
 
  });
     $("#apprNote").click(function(){
	  if(apprOn== 0)
	  {
		$("#apprShow").toggle("slide", {"direction": "up"}, function(){
		   $("#apprEdit").toggle("slide", {"direction": "up"});
		   apprOn = 1;
		   $("#apprNote").empty();
		   $("#apprNote").append("[close]");
	   });
	  }else
	  {
		  $("#apprEdit").toggle("slide", {"direction": "up"}, function(){
		   $("#apprShow").toggle("slide", {"direction": "up"});
		   apprOn = 0;
		   $("#apprNote").empty();
		   $("#apprNote").append("[edit]");
	   });
	  }
 
  });
</script>