<?php

/**
 * Clients Manage Bidders Task View
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: _client-dashboard.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');
?>
<div class="dashboard-container">
  <div class="dashboard-content-container" data-simplebar>
    <div class="dashboard-content-inner padding-0">
      <!-- Row -->
      <div class="row flex-column-reverse flex-xl-row">

        <div class="col-xl-8 ">
          <!-- Dashboard Box -->
          <div class="row">
            <div class="col-xl-12">
              <div class="dashboard-box main-box-in-row">
                <div class="headline">
                  <h4 class="margin-top-20 font-weight-700"><?php echo Lang::$word->FR_DASH_RP; ?></h4>
                  <div class="sort-by">
                    <a href="#" class="button wojo secondary color-white"><?php echo Lang::$word->FR_DASH_PAP; ?></a>
                  </div>
                </div>
                <div class="content">
                  <table class="table-basic table border-bottom font-size-13">
                    <tr>
                      <th colspan="11"><?php echo Lang::$word->PRJ_PROJECT; ?>/<?php echo Lang::$word->FR_DASH_CNTST_TITLE; ?></th>
                      <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->FR_DASH_BIDS; ?>/<?php echo Lang::$word->FR_DASH_ENT; ?></th>
                      <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->FR_DASH_AVG_BIDS; ?></th>
                      <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->FR_DASH_CL_BIDS; ?></th>
                      <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->FR_DASH_ST; ?></th>
                    </tr>
                    <tr>
                      <td colspan="11" data-label="Project/Contest Title">logo design</td>
                      <td class="padding-right-10 padding-left-10" data-label="Bids/entries">38</td>
                      <td class="padding-right-10 padding-left-10" data-label="Average Bid">$24 USD</td>
                      <td class="padding-right-10 padding-left-10" data-label="Close Bid">in 7 days</td>
                      <td class="padding-right-10 padding-left-10" data-label="Status">Open</td>
                    </tr>

                  </table>
                  <div class="row padding-bottom-20">
                    <div class="col-xl-12 text-center">
                      <a href="#"><?php echo Lang::$word->FR_DASH_VA; ?><i class="icon-material-outline-arrow-right-alt"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Dashboard Box / End -->

            </div>
            <div class="col-xl-12 col-xs-8">
              <div class="dashboard-box main-box-in-row">
                <div class="row padding-top-20 padding-bottom-20 border-bottom">
                  <h4 class="font-weight-700 col-8 margin-bottom-0 text-left"><?php echo Lang::$word->FR_DASH_RP; ?></h4>
                  <a href="#" class="col-4 padding-left-0 d-flex justify-content-end align-items-center"><?php echo Lang::$word->FR_DASH_VA; ?><i class="icon-material-outline-arrow-right-alt"></i></a>
                </div>
                <div class="content">
                  <div class="row padding-bottom-20">
                    <div class="col-xl-12 text-center padding-top-30 padding-bottom-30">
                      <span><?php echo Lang::$word->FR_DASH_SENT_1; ?></span>
                    </div>
                    <div class="col-12 col-sm-6 text-align-center padding-bottom-20">
                      <a class="btn border border-dark text-decoration-none text-dark width-100 white-unset" href="#"><?php echo Lang::$word->FR_DASH_WB_BUILT; ?></a>
                    </div>
                    <div class="col-12 col-sm-6 text-align-center padding-bottom-20">
                      <a class="btn border border-dark text-decoration-none text-dark width-100 white-unset" href="#"><?php echo Lang::$word->FR_DASH_DSGN; ?></a>
                    </div>
                    <div class="col-12 col-sm-6 text-align-center padding-bottom-20">
                      <a class="btn border border-dark text-decoration-none text-dark width-100 white-unset" href="#"><?php echo Lang::$word->FR_DASH_ED; ?></a>
                    </div>
                    <div class="col-12 col-sm-6 text-align-center padding-bottom-20">
                      <a class="btn border border-dark text-decoration-none text-dark width-100 white-unset" href="#"><?php echo Lang::$word->FR_DASH_SRVD; ?></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Dashboard Box / End -->

            </div>
            <div class="col-xl-12">
              <div class="dashboard-box main-box-in-row">
                <div class="headline">
                  <h4><?php echo Lang::$word->FR_DASH_NWS_FD; ?></h4>
                </div>
                <div class="content">
                  <div class="row">
                    <div class="col-xl-12 padding-bottom-20">
                      <div class="row padding-bottom-20 border-bottom margin-left-10 margin-right-10">
                        <div class="col-xl-1 text-right">
                          <img class="news-feed-pic" src="images/single-freelancer.jpg" alt="">
                        </div>
                        <div class="col-xl-10">
                          <div class="row">
                            <div class="col-xl-12 text-left">
                              <span>this and 37 others on commented on this post</span>
                            </div>
                            <div class="col-xl-12 text-left">
                              <span class="font-size-13">37 minutes ago</span>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-xl-12 padding-bottom-20">
                      <div class="row padding-bottom-20 border-bottom margin-left-10 margin-right-10">
                        <div class="col-xl-1 text-right">
                          <img class="news-feed-pic" src="images/single-freelancer.jpg" alt="">
                        </div>
                        <div class="col-xl-10">
                          <div class="row">
                            <div class="col-xl-12 text-left">
                              <span>Your Project has been posted</span>
                            </div>
                            <div class="col-xl-12 text-left">
                              <span class="font-size-13">37 minutes ago</span>
                            </div>
                            <div class="col-xl-12 padding-top-20">
                              <a href="#" class="btn border border-dark btn-sm text-decoration-none text-dark">
                                <?php echo Lang::$word->FR_DASH_VP; ?>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-xl-12 padding-bottom-20">
                      <div class="row padding-bottom-20 border-bottom margin-left-10 margin-right-10">
                        <div class="col-xl-1 text-right">
                          <img class="news-feed-pic" src="images/single-freelancer.jpg" alt="">
                        </div>
                        <div class="col-xl-10">
                          <div class="row">
                            <div class="col-xl-12 text-left">
                              <span>Your Project has been posted</span>
                            </div>
                            <div class="col-xl-12 text-left">
                              <span class="font-size-13">37 minutes ago</span>
                            </div>
                            <div class="col-xl-12 padding-top-20">
                              <a href="#" class="btn border border-dark btn-sm text-decoration-none text-dark">
                                <?php echo Lang::$word->FR_DASH_VP; ?>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-xl-12 padding-bottom-20 border-bottom">
                      <div class="row padding-bottom margin-left-10 margin-right-10">
                        <div class="col-xl-1 text-right">
                          <img class="news-feed-pic" src="images/single-freelancer.jpg" alt="">
                        </div>
                        <div class="col-xl-10">
                          <div class="row">
                            <div class="col-xl-12 text-left">
                              <span>this and 37 others on commented on this post</span>
                            </div>
                            <div class="col-xl-12 text-left">
                              <span class="font-size-13">37 minutes ago</span>
                            </div>
                            <div class="col-xl-9 padding-top-20">
                              <div class="row">
                                <div class="col-xl-4">
                                  <a href="#" class="btn border border-dark btn-sm text-decoration-none text-dark">
                                    <?php echo Lang::$word->FR_DASH_PAP; ?>
                                  </a>
                                </div>
                                <div class="col-xl-4">
                                  <a href="#" class="btn border border-dark btn-sm text-decoration-none text-dark">
                                    <?php echo Lang::$word->FR_DASH_BP; ?>
                                  </a>
                                </div>
                                <div class="col-xl-4">
                                  <a href="#" class="btn border border-dark btn-sm text-decoration-none text-dark">
                                    <?php echo Lang::$word->FR_DASH_SET_DT; ?>
                                  </a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Dashboard Box / End -->

            </div>
          </div>
        </div>
        <div class="clearfix visible-xl"></div>
        <div class="col-xl-4">

          <!-- Dashboard Box -->
          <!-- If you want adjust height of two boxes 
						 add to the lower box 'main-box-in-row' 
						 and 'child-box-in-row' to the higher box -->
          <div class="dashboard-box main-box-in-row">
            <div class="headline color-bg-dark-blue color-white">
              <h3></h3>
              <h5>Welcome back,</h5>
              <h2>userName</h2>
              <h2>@userName</h2>
            </div>

            <div class="content margin-top-15 margin-bottom-30">
              <div class="row margin-right-20 margin-left-20 padding-bottom-20 border-bottom">
                <div class="col-xl-12">
                  <div class="row">
                    <div class="padding-left-0 col-sm-6 text-left"><span><strong>Set your account</strong></span></div>
                    <div class="padding-left-0 padding-right-0 col-sm-6 text-right"><span>88%</span></div>
                  </div>
                </div>
                <div class="col-xl-12 padding-top-10 padding-bottom-10">
                  <div class="freelancer-indicators margin-0 width-i-100">
                    <div class="indicator width-i-100 margin-0">
                      <div class="indicator-bar" data-indicator-percentage="30"><span style="width: 30%;"></span></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row margin-top-15 margin-left-10 padding-bottom-30">
                <div class="col-sm-6">
                  <div class="row">
                    <div class="col-xl-12 padding-right-0">
                      <?php echo Lang::$word->FR_DASH_ACNT_BLNC; ?>
                    </div>
                    <div class="font-12 col-xl-12 text-center margin-top-15">
                      <span>$0.00USD</span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 text-right">
                  <a href="#" class="margin-right-15"> <?php echo Lang::$word->FR_DASH_DP_FND; ?> <i class="icon-material-outline-arrow-right-alt"></i></a>
                </div>
              </div>

            </div>
          </div>
          <!-- Dashboard Box / End -->
        </div>
        <!-- Dashboard Box / End -->
      </div>
    </div>
    <div class="clearfix visible-xl"></div>
  </div>
</div>