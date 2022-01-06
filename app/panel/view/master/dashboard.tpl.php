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
      <div class="row flex-column-reverse flex-xl-row padding-bottom-30">

        <div class="col-xl-8">
          <!-- Dashboard Box -->
          <div class="row">
            <div class="col-12">
              <div class="dashboard-box main-box-in-row">
                <div class="row padding-top-20 padding-bottom-20 p-15">
                  <h4 class="col-7  margin-top-10 font-weight-700"><?php echo Lang::$word->RECENT_PROJECT; ?></h4>
                  <div class="col-5 padding-left-0 d-flex justify-content-end align-items-center">
                    <a href="#" class="btn-sm--blue"><?php echo Lang::$word->POST_PROJECT; ?></a>
                  </div>
                </div>
                <div class="content">
                  <table class="table-basic table border-bottom font-size-13">
                    <tr>
                      <th colspan="11"><?php echo Lang::$word->POST_PROJECT; ?>/<?php echo Lang::$word->CONTEST_T; ?></th>
                      <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->BIDS; ?>/<?php echo Lang::$word->ENTRIES; ?></th>
                      <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->AVERAGE_BIDS; ?></th>
                      <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->CLOSE_BIDS; ?></th>
                      <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->STATUS; ?></th>
                    </tr>
                    <tr>
                      <td colspan="11" data-label="Project/Contest Title">logo design</td>
                      <td class="padding-right-10 padding-left-10" data-label="Bids/entries">38</td>
                      <td class="padding-right-10 padding-left-10" data-label="Average Bid">$24 USD</td>
                      <td class="padding-right-10 padding-left-10" data-label="Close Bid">in 7 days</td>
                      <td class="padding-right-10 padding-left-10" data-label="Status">Open</td>
                    </tr>
                    <tr>
                      <td colspan="11" data-label="Project/Contest Title">logo design</td>
                      <td class="padding-right-10 padding-left-10" data-label="Bids/entries">38</td>
                      <td class="padding-right-10 padding-left-10" data-label="Average Bid">$24 USD</td>
                      <td class="padding-right-10 padding-left-10" data-label="Close Bid">in 7 days</td>
                      <td class="padding-right-10 padding-left-10" data-label="Status">Open</td>
                    </tr>

                  </table>
                  <div class="col-xl-12 text-center padding-bottom-20 border-bottom">
                    <a href="#"><?php echo Lang::$word->VIEW_ALL; ?><i class="icon-material-outline-arrow-right-alt"></i></a>
                  </div>
                </div>
              </div>
              <!-- Dashboard Box / End -->

            </div>
            <div class="col-12">
              <div class="dashboard-box main-box-in-row">
                <div class="row padding-top-20 padding-bottom-20 p-15">
                  <h4 class="col-9  margin-top-10 font-weight-700"><?php echo Lang::$word->RECENT_PROJECT; ?></h4>
                  <a href="#" class="col-3 padding-left-0 d-flex justify-content-end align-items-center"><?php echo Lang::$word->VIEW_ALL; ?><i class="icon-material-outline-arrow-right-alt"></i></a>
                </div>
                <div class="content">
                  <table class="table-basic table border-bottom font-size-13">
                    <tr>
                      <th colspan="11"><?php echo Lang::$word->PRJ_PROJECT; ?>/<?php echo Lang::$word->CONTEST_T; ?></th>
                      <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->EMPLOYER; ?></th>
                      <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->BID_AMOUNT; ?></th>
                      <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->DEADLINE; ?></th>
                      <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->MILESTONES; ?></th>
                    </tr>
                    <tr>
                      <td colspan="11" data-label="<?php echo Lang::$word->PRJ_PROJECT; ?>/<?php echo Lang::$word->CONTEST_T; ?>">logo design</td>
                      <td class="padding-right-10 padding-left-10" data-label="<?php echo Lang::$word->EMPLOYER; ?>">AHMAD</td>
                      <td class="padding-right-10 padding-left-10" data-label="<?php echo Lang::$word->BID_AMOUNT; ?>">$24 USD</td>
                      <td class="padding-right-10 padding-left-10" data-label="<?php echo Lang::$word->DEADLINE; ?>">in 7 days</td>
                      <td class="padding-right-10 padding-left-10" data-label="<?php echo Lang::$word->MILESTONES; ?>">1</td>
                    </tr>

                  </table>
                  <div class="d-flex justify-content-center align-items-center flex-wrap padding-bottom-20">
                    <span><?php echo Lang::$word->DASH_INFO_3; ?></span>
                    <a href="#" class="btn-sm--blue margin-left-10"><?php echo Lang::$word->BROWSE_PROJECTS; ?></a>
                  </div>
                </div>
              </div>
              <!-- Dashboard Box / End -->

            </div>
            <div class="col-12">
              <div class="dashboard-box main-box-in-row">
                <div class="row padding-top-20 padding-bottom-20 p-15">
                  <h4 class="font-weight-700 col-9 margin-bottom-0 text-left"><?php echo Lang::$word->RECENT_PROJECT; ?></h4>
                  <a href="#" class="col-3 padding-left-0 d-flex justify-content-end align-items-center"><?php echo Lang::$word->VIEW_ALL; ?><i class="icon-material-outline-arrow-right-alt"></i></a>
                </div>
                <div class="outline-gray"></div>
                <div class="content">
                  <div class="row padding-bottom-40">
                    <div class="col-xl-12 text-center padding-top-30">
                      <i class="blue-dash font-200 icon-feather-bar-chart-2"></i>
                    </div>
                    <div class="col-xl-12 text-center padding-top-20">
                      <span><?php echo Lang::$word->DASH_INFO_1; ?></span>
                    </div>
                    <div class="col-xl-12 text-center padding-top-20">
                      <a href="#" class="btn-md--blue"><?php echo Lang::$word->BROWSE_PROJECTS; ?></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Dashboard Box / End -->

            </div>
            <div class="col-12">
              <div class="dashboard-box main-box-in-row">
                <div class="row padding-top-20 padding-bottom-20 p-15">
                  <h4 class="font-weight-700 col-9 margin-bottom-0 text-left"><?php echo Lang::$word->RECENT_PROJECT; ?></h4>
                  <a href="#" class="col-3 padding-left-0 d-flex justify-content-end align-items-center"><?php echo Lang::$word->VIEW_ALL; ?><i class="icon-material-outline-arrow-right-alt"></i></a>
                </div>
                <div class="outline-gray"></div>
                <div class="content">
                  <div class="row padding-bottom-20 text-center px-15">
                    <div class="col-xl-12 padding-top-30 padding-bottom-30">
                      <span><?php echo Lang::$word->DASH_INFO_2; ?></span>
                    </div>
                    <div class="col-12 col-sm-6 padding-bottom-20">
                      <a class="btn border border-dark text-decoration-none text-dark width-100 white-unset" href="#"><?php echo Lang::$word->GET_WEBSITE_BUILT; ?></a>
                    </div>
                    <div class="col-12 col-sm-6 padding-bottom-20">
                      <a class="btn border border-dark text-decoration-none text-dark width-100 white-unset" href="#"><?php echo Lang::$word->GET_DESIGN; ?></a>
                    </div>
                    <div class="col-12 col-sm-6 padding-bottom-20">
                      <a class="btn border border-dark text-decoration-none text-dark width-100 white-unset" href="#"><?php echo Lang::$word->GET_DATA_ENT_DONE; ?></a>
                    </div>
                    <div class="col-12 col-sm-6 padding-bottom-20">
                      <a class="btn border border-dark text-decoration-none text-dark width-100 white-unset" href="#"><?php echo Lang::$word->GET_SERVICES_DONE; ?></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Dashboard Box / End -->

            </div>
            <div class="col-12">
              <div class="dashboard-box main-box-in-row padding-bottom-15">
                <h4 class="margin-bottom-0 p-15 font-weight-700"><?php echo Lang::$word->NEWs_FEED; ?></h4>
                <div class="outline-gray"></div>
                <div class="content padding-top-15">
                  <div class="row">

                    <div class="col-3 col-sm-2 padding-right-5 text-center">
                      <img class="news-feed-pic" src="images/single-freelancer.jpg" alt="">
                    </div>
                    <div class="col-9 col-sm-10 padding-left-0">
                      <div class="text-left">
                        <span>this and 37 others on commented on this post</span>
                      </div>
                      <div class="text-left">
                        <span class="font-size-13">37 minutes ago</span>
                      </div>
                    </div>
                    <div class="col-12 py-15">
                      <div class="outline-gray"></div>
                    </div>
                    <div class="col-3 col-sm-2  padding-right-5 text-center">
                      <img class="news-feed-pic" src="images/single-freelancer.jpg" alt="">
                    </div>
                    <div class="col-9 col-sm-10 padding-left-0">
                      <div class="text-left">
                        <span>Your Project has been posted</span>
                      </div>
                      <div class="text-left">
                        <span class="font-size-13">37 minutes ago</span>
                      </div>
                      <div class="padding-top-5">
                        <a href="#" class="btn border border-dark btn-sm text-decoration-none text-dark">
                          <?php echo Lang::$word->VIEW_PROJECT; ?>
                        </a>
                      </div>
                    </div>
                    <div class="col-12 py-15">
                      <div class="outline-gray"></div>
                    </div>

                    <div class="col-3 col-sm-2  padding-right-0 text-center">
                      <img class="news-feed-pic margin-right-10" src="images/single-freelancer.jpg" alt="">
                    </div>
                    <div class="col-9 col-sm-10 padding-left-0">
                      <div>
                        <span>this and 37 others on commented on this post</span>
                      </div>
                      <div>
                        <span class="font-size-13">37 minutes ago</span>
                      </div>
                      <div class="padding-top-5">
                        <div class="margin-right-5 margin-bottom-5 d-inline-block">
                          <a href="#" class="btn border border-dark btn-sm text-decoration-none text-dark">
                            <?php echo Lang::$word->POST_PROJECT; ?>
                          </a>
                        </div>
                        <div class="margin-right-5 margin-bottom-5 d-inline-block">
                          <a href="#" class="btn border border-dark btn-sm text-decoration-none text-dark">
                            <?php echo Lang::$word->BROWSE_PROJECTS; ?>
                          </a>
                        </div>
                        <div class="margin-right-5 margin-bottom-5 d-inline-block">
                          <a href="#" class="btn border border-dark btn-sm text-decoration-none text-dark">
                            <?php echo Lang::$word->SET_ACC_DETAILS; ?>
                          </a>
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
        <div class="col-xl-4">

          <!-- Dashboard Box -->
          <!-- If you want adjust height of two boxes 
						 add to the lower box 'main-box-in-row' 
						 and 'child-box-in-row' to the higher box -->
          <div class="dashboard-box main-box-in-row">
            <div class="headline color-bg-dark-blue color-white">
              <h3></h3>
              <h5><?php echo Lang::$word->WELCOME_BACK; ?>,</h5>
              <h2>userName</h2>
              <h2>@userName</h2>
            </div>

            <div class="content margin-top-15 margin-bottom-30">
              <div class="padding-bottom-20 padding-left-10 padding-right-10 row">
                <div class="col-9"><span><strong><?php echo Lang::$word->ACC_SET; ?></strong></span></div>
                <div class="col-3 text-right"><span>88%</span></div>
                <div class="col-12">
                  <div class="freelancer-indicators width-i-100">
                    <div class="indicator margin-right-0 width-i-100">
                      <div class="indicator-bar" data-indicator-percentage="88"><span style="width: 10%;"></span></div>
                    </div>
                  </div>
                </div>
                <div class="col-12 py-15">
                  <div class="outline-gray  mx-n-10"></div>
                </div>
                <div class="col-6">
                  <div class="text-center">
                    <?php echo Lang::$word->ACC_BALANCE; ?> </div>
                  <div class="font-12 margin-top-15 text-center">
                    <span>$0.00 USD</span>
                  </div>
                </div>
                <div class="col-6 text-right">
                  <a href="#" class="margin-right-15"> <?php echo Lang::$word->DEPOSIT_FUNDS; ?> <i class="icon-material-outline-arrow-right-alt"></i></a>
                </div>
              </div>


            </div>
          </div>
          <!-- Dashboard Box / End -->
          <div class="dashboard-box main-box-in-row">
            <div class="row p-15">
              <h4 class="font-weight-700 col-8 margin-bottom-0"><?php echo Lang::$word->BIDS_SUMMARY; ?></h4>
              <a href="#" class="col-4 padding-left-0 d-flex justify-content-end align-items-center"><?php echo Lang::$word->VIEW_ALL; ?><i class="icon-material-outline-arrow-right-alt"></i></a>
            </div>

            <div class="content margin-bottom-30 padding-left-10 padding-right-10">
              <div class="row padding-bottom-15">
                <div class="col-12 padding-bottom-15">
                  <div class="outline-gray"></div>
                </div>
                <div class="col-10 padding-right-0"><span><strong><?php echo Lang::$word->REMAINING; ?></strong></span></div>
                <div class="col-2 text-right padding-left-0"><span>5/6</span></div>
                <div class="col-12 py-15">
                  <div class="outline-gray"></div>
                </div>
                <div class="col-7 padding-right-0"><span><strong><?php echo Lang::$word->BID_U; ?></strong></span></div>
                <div class="col-5 text-right padding-left-0"><span>in 3 days</span></div>
                <div class="col-12 py-15">
                  <div class="outline-gray"></div>
                </div>
                <div class="col-10 padding-right-0"><span><strong><?php echo Lang::$word->REP_RATE; ?></strong></span></div>
                <div class="col-2 text-right padding-left-0"><span>1x</span></div>
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