<?php
$facultyDetails = $this->db->query("select *  from faculty");
$DepartmentDetails = $this->db->query("select *  from department");
$designation=$this->db->get('erp_staff_designations');

?>
<div class="mail-env"> <!-- compose new email button --> <div class="mail-sidebar-row visible-xs"> <a href="<?php echo base_url();?>index.php?sadmin/composeMail" class="btn btn-success btn-icon btn-block">
Compose Mail
<i class="entypo-pencil"></i> </a> </div> <!-- Mail Body --> <div class="mail-body"> <div class="mail-header"> <!-- title --> <h3 class="mail-title">
Inbox
<span class="count">(5)</span> </h3> <!-- search --> <form method="get" role="form" class="mail-search"> <div class="input-group"> <input type="text" class="form-control" name="s" placeholder="Search for mail..."> <div class="input-group-addon"> <i class="entypo-search"></i> </div> </div> </form> </div> <!-- mail table --> <table class="table mail-table"> <!-- mail table header --> <thead> <tr> <th width="5%"> <div class="checkbox checkbox-replace neon-cb-replacement"> <label class="cb-wrapper"><input type="checkbox"><div class="checked"></div></label> </div> </th> <th colspan="4"> <div class="mail-select-options">Mark as Read</div> <div class="mail-pagination" colspan="2"> <strong>1-30</strong> <span>of 789</span> <div class="btn-group"> <a href="#" class="btn btn-sm btn-white"><i class="entypo-left-open"></i></a> <a href="#" class="btn btn-sm btn-white"><i class="entypo-right-open"></i></a> </div> </div> </th> </tr> </thead> <!-- email list --> <tbody> <tr class="unread"><!-- new email class: unread --> <td> <div class="checkbox checkbox-replace neon-cb-replacement"> <label class="cb-wrapper"><input type="checkbox"><div class="checked"></div></label> </div> </td> <td class="col-name"> <a href="#" class="star stared"> <i class="entypo-star"></i> </a> <a href="../message/index.html" class="col-name">Delta State Board of Internal Revenue</a> </td> <td class="col-subject"> <a href="../message/index.html">
Ministry of Lands
</a> </td> <td class="col-options"> <a href="../message/index.html"><i class="entypo-attach"></i></a> </td> <td class="col-time">13:52</td> </tr> <tr> <td> <div class="checkbox checkbox-replace neon-cb-replacement"> <label class="cb-wrapper"><input type="checkbox"><div class="checked"></div></label> </div> </td> <td class="col-name"> <a href="#" class="star"> <i class="entypo-star"></i> </a> <a href="../message/index.html" class="col-name">Ministry of Lands Allocation Letter</a> </td> <td class="col-subject"> <a href="../message/index.html">
Board of Internal Revenue
</a> </td> <td class="col-options"></td> <td class="col-time">09:27</td> </tr> <tr> <td> <div class="checkbox checkbox-replace neon-cb-replacement"> <label class="cb-wrapper"><input type="checkbox"><div class="checked"></div></label> </div> </td> <td class="col-name"> <a href="#" class="star"> <i class="entypo-star"></i> </a> <a href="../message/index.html" class="col-name">2020/2021 State IGR Presentation</a> </td> <td class="col-subject"> <a href="../message/index.html"> <span class="label label-danger">Business</span>
iGR Report
</a> </td> <td class="col-options"></td> <td class="col-time">Today</td> </tr> <tr> <td> <div class="checkbox checkbox-replace neon-cb-replacement"> <label class="cb-wrapper"><input type="checkbox"><div class="checked"></div></label> </div> </td> <td class="col-name"> <a href="#" class="star"> <i class="entypo-star"></i> </a> <a href="../message/index.html" class="col-name">Delta State Ministry of Local Government - Commissioners Office
o</a> </td> <td class="col-subject"> <a href="../message/index.html">
Over Throttle Alert
</a> </td> <td class="col-options"> <a href="../message/index.html"><i class="entypo-attach"></i></a> </td> <td class="col-time">Yesterday</td> </tr>  <tr> <td> <div class="checkbox checkbox-replace neon-cb-replacement"> <label class="cb-wrapper"><input type="checkbox"><div class="checked"></div></label> </div> </td> <td class="col-name"> <a href="#" class="star"> <i class="entypo-star"></i> </a> <a href="../message/index.html" class="col-name">Office of the Accountant General</a> </td> <td class="col-subject"> <a href="../message/index.html">
Bugs in your system.
</a> </td> <td class="col-options"></td> <td class="col-time">01 Sep</td> </tr> </tbody> <!-- mail table footer --> <tfoot> <tr> <th width="5%"> <div class="checkbox checkbox-replace neon-cb-replacement"> <label class="cb-wrapper"><input type="checkbox"><div class="checked"></div></label> </div> </th> <th colspan="4"> <div class="mail-pagination" colspan="2"> <strong>1-30</strong> <span>of 789</span> <div class="btn-group"> <a href="#" class="btn btn-sm btn-white"><i class="entypo-left-open"></i></a> <a href="#" class="btn btn-sm btn-white"><i class="entypo-right-open"></i></a> </div> </div> </th> </tr> </tfoot> </table> </div> <!-- Sidebar --> <div class="mail-sidebar"> <!-- compose new email button --> <div class="mail-sidebar-row hidden-xs"> <a href="../compose/index.html" class="btn btn-success btn-icon btn-block">
Compose Mail
<i class="entypo-pencil"></i> </a> </div> <!-- menu --> <ul class="mail-menu"> <li class="active"> <a href="#"> <span class="badge badge-danger pull-right">6</span>
Inbox
</a> </li> <li> <a href="#"> <span class="badge badge-gray pull-right">1</span>
Sent
</a> </li> <li> <a href="#">
Drafts
</a> </li>  <li> <a href="#">
Trash
</a> </li> </ul> <div class="mail-distancer"></div> <h4>Tags</h4> <!-- menu --> <ul class="mail-menu"> <li> <a href="#"> <span class="badge badge-danger badge-roundless pull-right"></span>
Proposals
</a> </li> <li> <a href="#"> <span class="badge badge-info badge-roundless pull-right"></span>
Files
</a> </li> <li> <a href="#"> <span class="badge badge-warning badge-roundless pull-right"></span>
Letters
</a> </li> </ul> </div> </div>