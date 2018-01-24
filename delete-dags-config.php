<?php
namespace Vanderbilt\DeleteDAGsExternalModule;

use ExternalModules\AbstractExternalModule;
use ExternalModules\ExternalModules;

require_once ExternalModules::getProjectHeaderPath();
require_once 'DeleteDAGsExternalModule.php';

$module = new DeleteDAGsExternalModule();
?>
    <link rel="stylesheet" type="text/css" href="<?=$module->getUrl('css/style.css')?>">

<script>
    $(function(){
        $('#deleteDag').click(function(){
            if($('#dag-ids').val() == ""){
                $('#errMsgContainer').show();
                $('#errMsgContainer').html("Please insert some DAG IDs.");
            }else{
                $('#errMsgContainer').hide();
                $('#confirm-delete').modal('show');
            }
        });

        $('#deleteDAGs').submit(function () {
            var data = "&dagIDs="+$('#dag-ids').val();
            var url = <?=json_encode($module->getUrl('delete-dags.php'))?>;

            $('#succMsgContainer').hide();
            $.ajax({
                type: "POST",
                url: url,
                data:data
                ,
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                },
                success: function (result) {
                    jsonAjax = jQuery.parseJSON(result);
                    if(jsonAjax.status == 'success') {
                        if(jsonAjax.message == 'format') {
                            $('#errMsgContainer').show();
                            $('#errMsgContainer').html("Incorrect format. Couldn't delete DAGs.");
                        }else{
                            $('#succMsgContainer').show();
                        }

                    }
                }
            });
            $('#confirm-delete').modal('hide');
            return false;
        });
    })
</script>

<div class="alert alert-success fade in col-md-12" style="border-color: #b2dba1 !important;display: none;" id="succMsgContainer">DAGs successfully deleted.</div>
<div class="alert alert-danger fade in col-md-12" style="!important;display: none;" id="errMsgContainer"></div>
<form method="post" id="deleteDAGs">
    <div class="container"  style='margin: 0 auto;float:none;'>
        <div class='container'>
            <div class="form-group">
                <div class="form-group" style="padding-top: 30px">
                    <label for="exampleFormControlTextarea1" style="font-weight: normal;padding-left: 15px;">Insert the <strong>DAG ID's</strong> to delete the DAGs and all the information associated with them.<br/>
                        <em>ID's can be separated by comma, semicolon or line break (not mixed).</em></label>
                </div>
                <div class="form-group col-md-6">
                    <textarea class="form-control" id="dag-ids" rows="6"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <div class="form-group col-md-6">
                        <button type='button' id="deleteDag" class='btn btn-info' style="float: right">Delete DAGs</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="Codes">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close closeCustomModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete Dags</h4>
                </div>
                <div class="modal-body">
                    <span>Are you sure to want to automatically delete all DAGs and the information associated to them?</span>
                </div>

                <div class="modal-footer">
                    <button type="submit" form="deleteDAGs" class="btn btn-default btn-delete" id='btnModalDeleteForm'>Delete</button>
                    <button type="button" class="btn btn-default" id='btnCloseCodesModalDelete' data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
//    $pid = $_GET['pid'];
//    $dagIds = $_POST['dag-ids'];
//    echo $dagIds;


//            $module->delete_dags($pid);

//    echo 'Done!';
}
