<?php
$fact = $this->db->query("select * from faculty order by faculty_name") or die ("Error fact ".mysql_error());
?><select name="school" id="school" class="country-line" required="required"><option value="">Select</option>
<?php foreach($fact->result() as $fact2){
	if(isset($_SESSION["appschool"])){
		if($fact2->faculty_name == $_SESSION["appschool"]){
		$sel = "selected='selected'";	
		}	
	}
	?>
<option value="<?php echo $fact2->faculty_name; ?>" id="<?php echo $fact2->faculty_id; ?>" onChange="getDepts(this.id);" onclick="getDepts(this.id);" <?php if(isset($sel)){ echo $sel; }?>><?php echo $fact2->faculty_name; ?></option>
<?php
unset($sel);
}
?>
</select>
