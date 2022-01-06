<?php

/**
 * Members
 *
 * @package Wojo Framework
 * @author wojoscripts.com
 * @copyright 2019
 * @version $Id: members.tpl.php, v1.00 2019-05-05 10:12:05 gewa Exp $
 */
if (!defined("_WOJO"))
  die('Direct access to this location is not allowed.');

if (!Auth::hasPrivileges('manage_people')) : print Message::msgError(Lang::$word->NOACCESS);
  return;
endif;
?>
<span style="display:none">
  <?php
  print_r($this->sql);
  echo "<br>";
  echo "<pre>";
  print_r($this->data);
  echo "</pre>";
  ?>
</span>
<style>
  .advancedSearch
  {
    overflow:hidden;
    <?php if (Url::segment($this->segments) != 'search' ) echo "display:none;"; ?>
  }
  .sortButton
  {
    display:initial!important;
    margin-right:7px;
  }
  main
  {
    margin-left:100px!important;;
  }
  #searchInput{
    border: thin solid #afafaf!important;
    border-radius: 5px!important;
    padding: 6px!important;
    transition:all 0.5s;
  }
  #searchInput:focus{
    outline:none!important;
    border:2.5px solid #0000a0!important;
    transition:all 0.5s;
  }
</style>
<!-- Page Content
================================================== -->
<div class="container-fluid">
  <div class="wrapper">
    <div class="dashboard-box main-box-in-row">
      <div class="row gutters align bottom" style="width:100%">
        <div class="columns phone-100">
          <div class="wojo small white stacked buttons">
            <a href="<?php echo Url::url("/admin/members", "freelancers"); ?>" class="wojo button<?php if (Url::segment($this->segments) === 'freelancers') echo ' active'; ?>"><?php echo Lang::$word->FREELANCERS; ?></a>
            <a href="<?php echo Url::url("/admin/members", "project"); ?>" class="wojo button<?php if (Url::segment($this->segments) === 'project') echo ' active'; ?>"><?php echo Lang::$word->PRJ_PROJECTS; ?></a>
            <a class="wojo button action" onClick="advancedSearch();"><?php echo Lang::$word->ADV_SRC; ?></a>
          </div>
        </div>
        <div class="columns auto phone-100 pt-2">
          <a href="#" onClick="javascript:fnExcelReport();" id="test" class="btn-sm--blue margin-right-10"><?php echo Lang::$word->REP_EXPORT_x; ?></a>
          <input id="searchInput" onkeyup="myFunction()" onfocusout="myFunction()" type="search" class="px-5 p-3" placeholder="Search...">
        </div>
      </div>
    <div class="wojo form advancedSearch">
      <form method="post" id="wojo_form" action="<?php echo Url::url("/admin/members/search"); ?>" name="wojo_form">
        <div class="container">
            <div class="row d-flex justif-content-around">
                  <div class=col-md-4>
                    <div class="wojo fields">
                      <div class="field">
                        <label>Fullname</label>
                        <input type="text" name="fullname" placeholder="John Doe" <?php if($_POST) echo 'value ="'.$_POST["fullname"].'"';?> >
                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="wojo fields">
                      <div class="field">
                        <label>Approval Status</label>
                          <input type="checkbox" name="approvedStatus[]" value="Approved"<?php if($_POST["approvedStatus"] && in_array("Approved",$_POST["approvedStatus"])) echo 'checked';?> >Approved</input><br>
                          <input type="checkbox" name="approvedStatus[]" value="Not Approved" <?php if($_POST["approvedStatus"] && in_array("Not Approved",$_POST["approvedStatus"])) echo 'checked';?>>Not Approved</input><br>
                          <input type="checkbox" name="approvedStatus[]" value="Penalized"<?php if($_POST["approvedStatus"] && in_array("Penalized",$_POST["approvedStatus"])) echo 'checked';?> >Penalized</input><br>
                          <input type="checkbox" name="approvedStatus[]" value="Not Sure" <?php if($_POST["approvedStatus"] && in_array("Not Sure",$_POST["approvedStatus"])) echo 'checked';?> >Not Sure</input><br>
                          <input type="checkbox" name="approvedStatus[]" value="On Hold" <?php if($_POST["approvedStatus"] && in_array("On Hold",$_POST["approvedStatus"])) echo 'checked';?> >On Hold</input><br>
                          <input type="checkbox" name="approvedStatus[]" value="Other" <?php if($_POST["approvedStatus"] && in_array("Other",$_POST["approvedStatus"])) echo 'checked';?> >Other</input>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="row">
                        <div class="col">
                          <div class="wojo fields">
                            <div class="field">
                              <label>Looking For</label>
                              <input type="text" name="empPref" placeholder="Freelance" <?php if($_POST) echo 'value ="'.$_POST["empPref"].'"';?> >
                            </div>
                          </div>
                          <div class="wojo fields">
                            <div class="field">
                              <label>Current Employment</label>
                              <input type="text" name="empType" placeholder="Full Time" <?php if($_POST) echo 'value ="'.$_POST["empType"].'"';?> >
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="wojo fields">
                        <div class="field">
                          <label>Price Range</label>
                          From <input type="number" name="from" <?php if($_POST) echo 'value ="'.$_POST["from"].'"';?>>
                          To <input type="number" name="to" <?php if($_POST) echo 'value ="'.$_POST["to"].'"';?>>
                        </div>
                    </div>
                    <div class="wojo fields" style="position:relative">
                      <div class="field">
                          <label>Available Hours</label><span style="position:absolute;top:-3px;right:10px;font-size:9pt">(0=null)</span>
                          <input type="range" name="hours" <?php if($_POST) echo 'value ="'.$_POST["hours"].'"';else echo 'value="0"';?> min="0" max="168" oninput="this.nextElementSibling.value = this.value">
                          <output><?php if($_POST) echo $_POST["hours"];else echo '0';?></output>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                        <div class="wojo fields" style="max-height:200px;">
                            <div class="field">
                              <label>Skills</label><span style="position:absolute;top:-3px;right:10px;font-size:9pt">Hold ctrl button to select multiple skills.</span>
                              <select id="skills" name="skills[]" class="js-example-basic-single" multiple="multiple" style="height:200px">
                              <?php foreach ($this->skills as $v) : ?>
                                <option value="<? echo $v->id ?>" <?php if($_POST["skills"] && in_array($v->id, $_POST["skills"])) echo 'selected';?>><?php echo $v->name;?></option>
                              <?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                  </div>
                  <div class="col-md-4">
                        <h4>Sort By:</h4>
                        <div class="wojo fields" style="max-height:200px;">
                            <div class="field">
                              <label class="sortButton">Name:</label><br>
                              <label for="name1" class="sortButton"><input type="radio" id="name1" name="sortName" <?php if($_POST && $_POST["sortName"] == "ASC") echo 'checked';?> value="ASC">
                              A - Z </label>
                              <label for="name2" class="sortButton"><input type="radio" id="name2" name="sortName" <?php if($_POST && $_POST["sortName"] == "DESC") echo 'checked';?> value="DESC">
                              Z - A</label>
                              <label for="name3" class="sortButton"><input type="radio" id="name3" name="sortName" value="">
                              None</label><br>
                              <label class="sortButton">Hourly Price:</label><br>
                              <label for="hourPrice1" class="sortButton"><input type="radio" id="hourPrice1" name="sortHourPrice" <?php if($_POST && $_POST["sortHourPrice"] == "ASC") echo 'checked';?> value="ASC">
                              Ascending </label>
                              <label for="hourPrice2" class="sortButton"><input type="radio" id="hourPrice2" name="sortHourPrice" <?php if($_POST && $_POST["sortHourPrice"] == "DESC") echo 'checked';?> value="DESC">
                              Descending</label>
                              <label for="hourPrice3" class="sortButton"><input type="radio" id="hourPrice3" name="sortHourPrice" value="">
                              None</label><br>
                              <label class="sortButton">Available Hour:</label><br>
                              <label for="hour1" class="sortButton"><input type="radio" id="hour1" name="sortHour" <?php if($_POST && $_POST["sortHour"] == "ASC") echo 'checked';?> value="ASC">
                              Ascending </label>
                              <label for="hour2" class="sortButton"><input type="radio" id="hour2" name="sortHour" <?php if($_POST && $_POST["sortHour"] == "DESC") echo 'checked';?> value="DESC">
                              Descending</label>
                              <label for="hour3" class="sortButton"><input type="radio" id="hour3" name="sortHour" value="">
                              None</label><br>
                            </div>
                          </div>
                  </div>
              </div>
              <div class="row">
                <div class="col" style="position:relative;">
                  <button style="position:absolute;bottom:30px;right:50px;" class="wojo small primary button"><?php echo Lang::$word->SEARCH;?></button>
                </div>
              </div>
            </div>
         </form>
      </div>
      <div class="content">
        <?php if (Url::segment($this->segments) === 'freelancers' || Url::segment($this->segments) === 'search' ) : ?>
          <table id="tblData" data-name="Freelancers" class="table-basic table border-bottom font-size-13">
            <thead>
              <tr>
                <th class="padding-right-5"><?php echo Lang::$word->NAME; ?></th>
			    <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->APPR; ?></th>
			    <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->TITLE; ?></th>
                <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->SHORT_CV; ?></th>
                <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->ONG_PROJ; ?></th>
                <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->CONF_SKILLS; ?></th>
                <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->LOOKING_FOR; ?></th>
				        <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->CURRENT_EMP; ?></th>
                <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->HOURLY_PRICE; ?></th>
                <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->AVAIL_HOURS; ?></th>
                <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->INT_NOTES; ?></th>
                <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->OPERATION; ?></th>
              </tr>
            </thead>
            <tbody id="tbody">
              <?php if (isset($this->data['ncmp'])) : ?>
                <?php foreach ($this->data['ncmp'] as $i => $row) : ?>
                  <?php //print_r($row);?>
                  <?php if ($row->is_completed) : ?>
                    <tr>
                      <td data-label="<?php echo Lang::$word->NAME; ?>"><a class="d-inline-block" target="_BLANK" href="<?php echo Url::url('/admin/members/' . $row->username); ?>"><?php echo $row->fullname; ?></a></td>
                      <td data-label="<?php echo Lang::$word->APPR; ?>"><span class="d-inline-block"><?php
				switch ($row->approvalStatus ) {
					case "Approved":
						echo '<span class="badge badge-success">'.$row->approvalStatus.'</span>';
						$k=1;
						break;
					case "Not Approved":
						echo '<span class="badge badge-secondary">'.$row->approvalStatus.'</span>';
						$k=2;
						break;
					case "Penalized":
						echo '<span class="badge badge-danger">'.$row->approvalStatus.'</span>';
						$k=3;
						break;
					case "Not Sure":
						echo '<span class="badge badge-primary">'.$row->approvalStatus.'</span>';
						$k=4;
						break;
					case "On Hold":
						echo '<span class="badge badge-warning">'.$row->approvalStatus.'</span>';
						$k=5;
						break;
					case "Other":
						echo '<span class="badge badge-info">'.$row->approvalStatus.'</span>';
						$k=6;
						break;
				}
				?></span></td>
				<td data-label="<?php echo Lang::$word->TITLE; ?>"><?php echo $row->headline; ?></td>
					<td data-label="<?php echo Lang::$word->SHORT_CV; ?>"><div class="d-inline-block  hidden-ellipsed-text"> <a data-set='{"option":[{"action":"showShortCV","id": <?php echo $row->uid; ?>}],"label":"Save","redirect":true, "url":"helper.php", "parent":"#item_<?php echo $row->uid; ?>", "complete":"refresh", "modalclass":"normal"}' class="action white-space-nowrap"><?php echo $row->short_CV; ?></a></div>
                  </td>
                  <td data-label="<?php echo Lang::$word->ONG_PROJ; ?>">
                        <div class="d-inline-block  hidden-ellipsed-text"><?php if(isset($row->project)){$projectCount = explode(",",$row->project);echo count($projectCount);}?></div>
                      </td>
                      <td data-label="<?php echo Lang::$word->CONF_SKILLS; ?>">
                        <div class="d-inline-block  hidden-ellipsed-text"> <a data-set='{"option":[{"action":"showSkillsConf","id": <?php echo $row->uid; ?>}], "url":"helper.php", "parent":"#item_<?php echo $row->uid; ?>", "complete":"highlite", "modalclass":"normal"}' class="action white-space-nowrap"><?php echo $row->skills; ?></a></div>
                      </td>
                      <td data-label="<?php echo Lang::$word->LOOKING_FOR; ?>"><span class="d-inline-block"><?php echo $row->emp_prefer; ?></span></td>
					            <td data-label="<?php echo Lang::$word->CURRENT_EMP; ?>"><span class="d-inline-block"><?php echo $row->emp_type; ?></span></td>
                      <td data-label="<?php echo Lang::$word->HOURLY_PRICE; ?>"><span class="d-inline-block"><?php echo $row->hourly_rate; ?> <?php echo $row->currency; ?></span></td>
                      <td data-label="<?php echo Lang::$word->AVAIL_HOURS; ?>"><span class="d-inline-block"><?php echo $row->available_hour; ?>h</span></td>
                      <td data-label="<?php echo Lang::$word->INT_NOTES; ?>">
                        <div class="d-inline-block  hidden-ellipsed-text"><a data-set='{"option":[{"action":"addUserNote","id": <?php echo $row->uid; ?>}], "label":"<?php echo Lang::$word->SAVE; ?>", "url":"helper.php", "parent":"#item_<?php echo $row->uid; ?>", "complete":"highlite", "modalclass":"normal"}' class="action white-space-nowrap"> <?php echo $row->note; ?></a></div>
                      </td>
                      <td data-label="<?php echo Lang::$word->OPERATION; ?>">
                        <a class="btn-sm--blue action p-3 px-5 font-15" data-set='{"option":[{"action":"addtoClientProjects","id": <?php echo $row->uid; ?>}], "label":"<?php echo Lang::$word->ADDPROJECT; ?>", "url":"helper.php", "parent":"#item_<?php echo $row->uid; ?>", "complete":"highlite", "modalclass":"normal"}' title="<?php echo Lang::$word->ADDPROJECT; ?>"><i class=" icon-material-outline-add-circle-outline"></i></a>
                        <a class="btn-sm--blue margin-right-10 margin-top-20 action p-3 px-5 font-15" data-set='{"option":[{"action":"addUserNote","id": <?php echo $row->uid; ?>}], "label":"Add Note","redirect":true, "url":"helper.php", "parent":"#item_<?php echo $row->uid; ?>", "complete":"refresh", "modalclass":"normal"}' title="<?php echo Lang::$word->INV_SUB7; ?>"><i class="icon-material-outline-note-add"></i></a>
                      </td>
                    </tr>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        <?php else : ?>
          <table id="tblData" data-name="Projects" class="table-basic table border-bottom font-size-13">
            <thead>
              <tr>
                <th class="padding-right-5"><?php echo Lang::$word->TITLE; ?></th>
                <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->WORK_TYPE; ?></th>
                <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->SKILLS; ?></th>
                <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->LOOKING_FOR; ?></th>
                <th class="padding-right-5 padding-left-0"><?php echo Lang::$word->CREATED_BY; ?></th>
              </tr>
            </thead>
            <tbody id="tbody">
              <?php if (isset($this->data['ncmp'])) : ?>
                <?php foreach ($this->data['ncmp'] as $i => $row) : ?>
                  <tr>
                    <td data-label="<?php echo Lang::$word->TITLE; ?>"><a class="d-inline-block" target="_BLANK" href="<?php echo Url::url('/admin/members/project/' . $row->id); ?>"><?php echo $row->name; ?></a></td>
                    <td data-label="<?php echo Lang::$word->WORK_TYPE; ?>"><span class="d-inline-block"><?php echo $row->work_type; ?></span> (<?php echo ($row->required_dev) ? $row->required_dev : 0; ?><span class="icon-material-outline-group"></span>)</td>
                    <td data-label="<?php echo Lang::$word->SKILLS; ?>">
                      <div class="d-inline-block  hidden-ellipsed-text"> <span class="white-space-nowrap"><?php echo $row->skills; ?></span></div>
                    </td>
                    <td data-label="<?php echo Lang::$word->LOOKING_FOR; ?>"><span class="d-inline-block"><?php echo ucwords($row->skill); ?></span></td>
                    <td data-label="<?php echo Lang::$word->CREATED_BY; ?>"><span class="d-inline-block"><?php echo ucwords($row->created_by_name); ?></span></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
        <?php endif; ?>
      </div>
      <!-- Dashboard Box / End -->
    </div>
  </div>
  <script>
    function fnExcelReport() {
      var listName = $('#tblData').data('name');
      var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
      tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';

      tab_text = tab_text + '<x:Name>' + listName + ' List</x:Name>';

      tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
      tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';

      tab_text = tab_text + "<table border='1px'>";
      tab_text = tab_text + $('#tblData').html();
      tab_text = tab_text + '</table></body></html>';

      var data_type = 'data:application/vnd.ms-excel';

      var ua = window.navigator.userAgent;
      var msie = ua.indexOf("MSIE ");

      if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
        if (window.navigator.msSaveBlob) {
          var blob = new Blob([tab_text], {
            type: "application/csv;charset=utf-8;"
          });
          navigator.msSaveBlob(blob, listName + '_List.xls');
        }
      } else {
        $('#test').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
        $('#test').attr('download', listName + '_List.xls');
      }

    }

    function myFunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("tblData");
      tbody = document.getElementById("tbody");
      tr = tbody.getElementsByTagName("tr");
      th = table.getElementsByTagName("th");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        tr[i].style.display = "none";
        for (var j = 0; j < th.length; j++) {
          td = tr[i].getElementsByTagName("td")[j];
          if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter.toUpperCase()) > -1) {
              tr[i].style.display = "";
              break;
            }
          }
        }
      }
    }
  </script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
function advancedSearch()
{
      $(".advancedSearch").toggle("slide", {"direction":"up"});
}
</script>
