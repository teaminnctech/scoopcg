<?php
foreach($file as $files){
?>

<!--	<img width="232" height="217" 
    src="data:image/jpeg;base64,<?php //echo base64_encode($files['image']); ?>" />-->
    <img width="232" height="217" 
    src="<?php echo ($files['image']); ?>" />
<?php 
}
?>
