<?php
  /**
   * Add Event
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2019
   * @version $Id: addEvent.tpl.php, v1.00 2019-03-02 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
?>
<style>
  main{
    margin-left:80px!important;
  }
  .card
  {
    background:#fff;
    padding:20px;
    border-radius:7px;
    box-shadow: 0 4px 7px #cfcfcf;
  }
  .form-control{
    width:100%;
    border: thin solid #cbcbcb;
    border-radius:7px;
    height:40px;
    padding-left:5px;
    font-size:11pt;
  }
  .row
  {
    width:100%;
    padding-left:20px;
  }
  .form-item
  {
    width:100%;
    position:relative;
    padding-bottom:25px;
  }
  .delete-icon {
    color: #fff!important;
    background: #D11A2A;
    padding: 5px;
    padding-left: 6px;
    padding-right: 6px;
    border-radius: 5px;
}
.delete-icon:hover {
    color: #D11A2A!important;
    background: #fff;
}
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css"> 
<div class="container-fluid">
  <div class="row d-flex justify-content-around">
    <div class="card col-md-4" style="height:190px;">
      <div class="wrapper">
        <div class="row">
           <div class="col"> 
            <h4>Add New Skill</h4>
          </div>
          <hr></hr>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-item">
              <label>Name</label><br>
              <input type="text" name="skillName" id="skillName" class="form-control" placeholder="MySQL">
            </div>
            <div class="form-item">
            <button style="position:absolute;bottom:0px;right:0px;" class="wojo small primary button save"><?php echo Lang::$word->SAVE;?></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card col-md-7 tableCard">
      <table id="skillTable" class="table-basic table border-bottom font-size-13">
        <thead>
          <tr>
            <th>id</th>
            <th><?php echo Lang::$word->NAME ?></th>
            <th><?php echo Lang::$word->OPT ?></th>
          </tr>
        </thead>
      </table>
    <div>
  </div>
</div>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
<script type="text/javascript"> 
  var table = $('#skillTable').DataTable({
      "ajax": "<?php echo Url::url("/admin/skills/data");?>",
      "order": [ 0, 'desc' ],
      "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "options" }
        ],
        buttons: [
        {
            text: 'Reload',
            action: function ( e, dt, node, config ) {
                dt.ajax.reload();
            }
        }
    ]
    });
$(document).ready( function () {
  table.ajax.reload();
  
    $(".save").click( function (){
      
        var name = $("#skillName").val();
        $.ajax({
          type: "POST",
          url: "<?php echo Url::url("/admin/skills/addNew");?>",
          data: {"name":name},
          success: function(json){ 
            table.ajax.reload();
            $.wNotice(decodeURIComponent(json.message), {
                        autoclose: 12000,
                        type: json.type,
                        title: json.title
                    });
          },
          dataType: "json"
        });
    });
} );
function deleteSkill(name, id){
      
      confirm("Are you sure to delete "+name+"?");
      $.ajax({
        type: "POST",
        url: "<?php echo Url::url("/admin/skills/delete");?>",
        data: {"id":id},
        success: function(json){ 
          table.ajax.reload();
          $.wNotice(decodeURIComponent(json.message), {
                      autoclose: 12000,
                      type: json.type,
                      title: json.title
                  });
        },
        dataType: "json"
      });
  }

 
</script>