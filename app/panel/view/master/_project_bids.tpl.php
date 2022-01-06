<?php

/**
 * Files
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: files.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>

<h3><?php echo Lang::$word->PROJECT_BIDS; ?></h3>
<?php include_once(MASTERBASE . '/snippets/project_header.tpl.php'); ?>
<?php if (!$this->bids) : ?>
  <div class="center aligned margin-top-50"><img src="<?php echo MASTERVIEW; ?>/images/files_empty.svg" alt="" class="wojo center large image">
    <p class="wojo semi grey text"><?php echo Lang::$word->BIDS_INFO; ?></p>
  </div>
<?php else : ?>
  <div class="dashboard-container">
    <div class="dashboard-content-container">
      <div class="dashboard-content-inner padding-bottom-30">
        <!-- Row -->
        <div class="row">
          <!-- Dashboard Box -->
          <div class="col-xl-12">
            <div class="dashboard-box margin-top-0">
              <!-- Headline -->
              <div class="headline">
                <h3 class="margin-bottom-0"><i class="icon-material-outline-supervisor-account"></i>
                  <?php echo count($this->bids) . ' ' . Lang::$word->BIDDERS; ?></h3>
                <div class="sort-by">
                  <select class="selectpicker show-tick" onchange="location = this.value;">
                    <option value="<?php echo Url::url("/master/projects/bids", $this->row->id); ?>">
                      <?php echo Lang::$word->LATEST_FIRST; ?></option>
                    <option <?php if (Url::isActive("order", 'highest')) echo "selected"; ?> value="<?php echo Url::buildUrl("order", 'highest'); ?>"><?php echo Lang::$word->HIGHEST_FIRST; ?>
                    </option>
                    <option <?php if (Url::isActive("order", 'lowest')) echo "selected"; ?> value="<?php echo Url::buildUrl("order", 'lowest'); ?>"><?php echo Lang::$word->LOWEST_FIRST; ?>
                    </option>
                    <?php if ($this->row->work_type === "Project Based") : ?>
                      <option <?php if (Url::isActive("order", 'fastest')) echo "selected"; ?> value="<?php echo Url::buildUrl("order", 'fastest'); ?>"><?php echo Lang::$word->FASTEST_FIRST; ?>
                      </option>
                    <?php else : ?>
                      <option <?php if (Url::isActive("order", 'payment')) echo "selected"; ?> value="<?php echo Url::buildUrl("order", 'payment'); ?>"><?php echo Lang::$word->BY_PAYMENT; ?>
                      </option>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="content">
                <ul class="dashboard-box-list">
                  <?php foreach ($this->bids as $bid) : ?>
                    <li id="bid_<?php echo $bid->id; ?>">
                      <!-- Overview -->
                      <div class="freelancer-overview manage-candidates">
                        <div class="freelancer-overview-inner">
                          <div class="row">
                          <!-- Avatar -->
                          <div class="col-xl-1 col-lg-1 col-md-2 col-sm-2 col-12">
                          <div class="freelancer-avatar" style=" width: 100%; ">
                            <div class="verified-badge"></div>
                            <img src="<?php echo ($bid->avatar) ? UPLOADURL . "/avatars/" . $bid->avatar : MASTERVIEW . "/images/user-avatar-placeholder.png"; ?>" class="img-fluid" alt="">
                          </div>
                          </div>

                          <div class="col-xl-8 col-lg-8 col-md-7 col-sm-7 col-12">
                          <!-- Name -->
                          <div class=" freelancer-name">
                            <h4><a href="<?php echo Url::url('/master/profile/view', $bid->username) ?>"><?php echo ucwords($bid->uname) . ' '; ?><img class="flag" src="<?php echo UPLOADURL . '/flags/' . strtolower($bid->country) . '.svg'; ?>" alt="" title="<?php echo Utility::searchForValueName("iso_alpha2", $bid->country, "name", $this->countryList); ?>" data-tippy-placement="right"></a></h4>
                            <!-- Details -->
                            <?php /*<span class="freelancer-detail-item"><i class="icon-feather-mail"></i>
                              <?php echo $bid->email; ?></span>
                            <span class="freelancer-detail-item"><i class="icon-feather-phone"></i>
                              <?php echo $bid->phone; ?></span> */?>
                            <!-- description -->
                            <div class="freelancer-bids-description"><span><?php echo $bid->proposal; ?></span>
                            </div>
                            <?php if ($this->row->work_type === "Project Based") : ?>
                              <h5 class="margin-top-10"><?php echo Lang::$word->PROP_MILESTONES; ?></h5>
                              <div class="freelancer-bids-description">
                                <?php foreach ($this->milestones as $milestone) : ?>
                                  <?php if (intval($bid->id) == intval($milestone->bid_id)) : ?>
                                    <div class="row row-eq-height" style="margin: 15px 0 ">
                                      <div class="col-md-2  d-flex align-items-center bd-highlight mb-3">
                                        <span class="freelancer-detail-item d-inline-flex align-items-center justify-content-center flex-grow-1 font-size-13  px-5 padding-bottom-2" style="line-height: 1.3em;"><i class="<?php echo ($this->row->currency === 'TRY') ? 'icon-line-awesome-turkish-lira' : 'icon-line-awesome-dollar'; ?>"></i><span class="padding-top-3"><?php echo $milestone->amount; ?></span></span>
                                      </div>
                                      <div class="col-md-10  d-flex align-items-center bd-highlight mb-3">
                                        <span class="freelancer-detail-item  px-5 padding-top-2 padding-bottom-2 font-size-13" style="line-height: 1.3em;"><?php echo $milestone->task; ?></span>
                                      </div>
                                    </div>
                                        
                                        
                                        
                                        
                                  <?php endif; ?>
                                <?php endforeach; ?>
                              </div>
                            <?php endif; ?>
                            <!-- Buttons -->
                            <div class="buttons-to-right always-visible margin-top-25 margin-bottom-0">
                              <?php if ($bid->status == 1) : ?>
                                <a data-set='{"option":[{"action": "approveBid","title": "<?php echo ucwords($bid->uname) . " (" . App::Utility()->formatNumber($bid->bid_amount) . (($this->row->currency === 'TRY') ? " ₺)" : " $)"); ?>","id": "<?php echo $bid->id; ?>"}],"subtext":"","action":"offer","redirect":"<?php echo Url::url('/master/projects/bids', $bid->project_id); ?>"}' class="button ripple-effect color-white data"><i class="icon-material-outline-check"></i> <?php echo Lang::$word->ACCEPT_OFFER; ?></a>
                                <a class="button dark ripple-effect" data-bidder="<?=$bid->user_id;?>" data-authuser="<?=App::Auth()->uid;?>" data-pid="<?=$this->pID;?>" id="send-message"><i class="icon-feather-mail"></i> <?php echo Lang::$word->PLAN_MEETING; ?></a>
                                
                                <?php elseif ($bid->status == 2) : ?>
                                <a class="button ripple-effect color-white"><i class="icon-material-outline-thumb-up"></i> <?php echo Lang::$word->ACCEPTED; ?></a>
                                <a class="button dark ripple-effect" id="send-message"><i class="icon-feather-mail"></i> <?php echo Lang::$word->PLAN_MEETING; ?></a>
                              <?php else : ?>
                                <a class="button ripple-effect color-white"><i class="icon-material-outline-thumb-down"></i> <?php echo Lang::$word->DECLINED; ?></a>
                              <?php endif; ?>
                            </div>
                          </div>
                          </div>

                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12 d-flex align-items-center bd-highlight mb-3">
                            <!-- Bid Details -->
                            <ul class="dashboard-task-info bid-info">
                              <li><strong><i class="<?php echo ($this->row->currency === 'TRY') ? 'icon-line-awesome-turkish-lira' : 'icon-line-awesome-dollar'; ?> font-weight-700"></i><?php echo App::Utility()->formatNumber($bid->bid_amount); ?></strong><span><?php echo Lang::$word->BID_AMOUNT; ?></span>
                              </li>
                              <?php if ($this->row->work_type === "Project Based") : ?>
                                <li>
                                  <strong><?php echo $bid->delivery_time . " " . (($bid->delivery_time > 1) ? (($bid->time_type === "day") ? ucwordS(Lang::$word->_DAYS) : ucwordS(Lang::$word->_HOURS)) : ucwordS($bid->time_type)); ?></strong><span><?php echo Lang::$word->DELIVERY_TIME; ?></span>
                                </li>
                              <?php else : ?>
                                <li>
                                  <strong><?php echo ucwordS($bid->payment_type); ?></strong><span><?php echo Lang::$word->TIME; ?></span>
                                </li>
                              <?php endif; ?>
                            </ul>
                          </div>


                        </div>
                        </div>
                      </div>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- Row / End -->
      </div>
    </div>
  </div>
  <!-- Dashboard Content / End -->
  <script>// Variable to hold request
var request;

// Bind to the submit event of our form
$("#send-message").on('click', function(event){

    // Prevent default posting of form - put here to work in case of errors
    event.preventDefault();

    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $(this);
    var projectID = $form.attr('data-pid'), 
    bidderID = $form.attr('data-bidder'), 
    aUsr = $form.attr('data-authuser'), 
    
    // Fire off the request to /form.php
    request = $.ajax({
        url: "https://remotify.co/app/panel/master/projects/plan_meeting/",
        type: "post",
        data: { projectID:projectID, bidderID:bidderID, aUsr:aUsr}
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        console.log("Hooray, it worked!");
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });
});</script>
<?php endif; ?>
