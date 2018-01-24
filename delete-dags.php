<?php
namespace Vanderbilt\DeleteDAGsExternalModule;

use ExternalModules\AbstractExternalModule;
use ExternalModules\ExternalModules;

require_once 'DeleteDAGsExternalModule.php';

//$module = new DeleteDAGsExternalModule();

$dagIDs = $_POST['dagIDs'];
$dags = "";
$message = "";

if (strpos($dagIDs, ";") !== false) {
    $dags = explode(";",$dagIDs);
}else if (strpos($dagIDs, ",") !== false) {
    $dags = explode(",",$dagIDs);
}else if (strpos($dagIDs, "\n") !== false) {
    $dags = explode("\n",$dagIDs);
}else if(is_numeric($dagIDs)){
    //We call the deleteDAG function in External Modules code
    $module->deleteDAG($dagIDs);
}else{
    //ERROR
    $message = 'format';
}

//if($dags != ""){
//    foreach ($dags as $id){
//        $module->delete_dags($id);
//    }
//}

echo json_encode(array(
    'status' => 'success',
    'data' => $dagIDs,
    'message' => $message
));

?>