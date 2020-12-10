<style type="text/css">
    .modal .modal-body {
    
    }
    .modal-overlay {
  /* A dark translucent div that covers the whole screen */
  position:absolute;
  z-index:9999;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background-color:#000000;
  opacity: 0.8;
}
    .modal {
  height: 50%;
  z-index:10000;
  position: absolute;
  width: 50%; /* Default */

  /* Center the dialog */
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -webkit-transform: translate(-50%, -50%);
  -moz-transform: translate(-50%, -50%);

  /*background-color: #fff;
  box-shadow: 4px 4px 80px #000;*/
  
    }
  .modal-content {
  position: relative;
    height: 80%;
    border:1px solid red;
    /*overflow-y: scroll;*/
  }
</style>
<div class="row">
    <div class="col-md-12">
    <!--CONTROL TABS START-->
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i>
                    <?php echo get_phrase('Old Fees Payment List (2009 - 2014)');?>
                </a></li>
        </ul>

        <!--CONTROL TABS END-->
      <div class="widget stacked widget-table">
	   <div class="widget-content">
        <div class="tab-content">

            <!--TABLE LISTING STARTS-->

            <div class="tab-pane box active" id="list">
                <!-- Content resides here -->

                <div class="col-md-12" ng-controller="etzCrtl">

                    <div class="col-md-12">  <!--try row-->
                        <div class="col-md-2">PageSize:
                            <select ng-model="entryLimit" class="form-control">
                                <option>5</option>
                                <option>10</option>
                                <option>20</option>
                                <option>50</option>
                                <option>100</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <h5>Filtered {{ filtered.length }} of {{ totalItems}} total Payments</h5>
                        </div>
                        <div class="col-md-3">Filter:
                            <input type="text" ng-model="search" ng-change="filter()" placeholder="Filter" class="form-control" />
                        </div>
                    </div>
                    <br/>
                    
                    <div class="col-md-12"> <!--try row-->
                        <div style="width:100%;  text-align:center;" class="col-md-10">
                        <img id="spinner" ng-src="assets/images/preloader.gif" style="margin:auto;display:none;">
                        </div>
                        <div class="col-md-10" ng-show="filteredItems > 0">
                            <table class="table table-bordered datatable">
                            <thead>
                            <th><a ng-click="sort_by('id');">#&nbsp;<i class="glyphicon glyphicon-sort"></i></a></th>   
                            <th><a ng-click="sort_by('customer_id');">Reg No&nbsp;<i class="glyphicon glyphicon-sort"></i></a></th>
                            <th><a ng-click="sort_by('fullname');">Full Name&nbsp;<i class="glyphicon glyphicon-sort"></i></a></th>
                            <th><a ng-click="sort_by('confirm_code');">Confirmation Code&nbsp;<i class="glyphicon glyphicon-sort"></i></a></th>
                            <!--th><a ng-click="sort_by('receipt_no');">Receipt No&nbsp;<i class="glyphicon glyphicon-sort"></i></a></th-->
                            <th><a ng-click="sort_by('description');">Description&nbsp;<i class="glyphicon glyphicon-sort"></i></a></th>
                            <th><a ng-click="sort_by('amount');">Amount(N)&nbsp;<i class="glyphicon glyphicon-sort"></i></a></th>  
                            <th><a ng-click="sort_by('bankname');">Bank Name&nbsp;<i class="glyphicon glyphicon-sort"></i></a></th>  
                            <th>Edit&nbsp;</th>  
                            <th>Delete&nbsp;</th>                           
                            </thead>
                            <?php //$i=1;?>
                            <tbody>
                                <tr ng-repeat="data in filtered = (list | filter:search | orderBy : predicate :reverse) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                                    <td>{{data.id}}</td>
                                    <td>{{data.customer_id}}</td>
                                    <td>{{data.fullname}}</td>
                                    <td>{{data.confirm_code}}</td>                                    
                                    <!--td>{{data.receipt_no}}</td-->                                    
                                    <td>{{data.description}}</td>
                                    <td>{{data.amount}}</td>
                                    <td>{{data.bankname}}</td>
                                    <td>
                                    <button type="submit" ng-click="edit(data.id)" class="btn btn-info xs-3"><i class="entypo-pencil"></i>Edit</button></td>
                                    <td>
                                    <button type="submit" ng-click="delete(data.id)" class="btn btn-danger xs-3"><i class="entypo-trash"></i></button></td>
                                </tr>
                                <?php //$i++;?>
                            </tbody>
                            </table>
                        </div>
                        <div class="col-md-10" ng-show="filteredItems == 0">
                            <div class="col-md-10 pull-left">
                                <h4>No Student Payments found</h4>
                            </div>
                        </div>
                        <div class="col-md-8" ng-show="filteredItems > 0" style="width:100%;margin:auto;text-align:center;">    
                            <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" max-size="maxSize" rotate="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Second Controller starts here -->
                <div ng-controller="ModalCtrl">
                <script type="text/ng-template" id="myModalCntent.html">
                <p>Eka bodt</p>
                </script>
                </div>
                <div ng-controller="ModalCtrl">
                <script type="text/ng-template" id="myModalContent.html">  
            <div style="width:100%;  text-align:center;" class="col-md-10">
                        <img id="spin" ng-src="assets/images/preloader.gif" style="margin:auto;display:none;">
            </div>    
        <div class="modal-header">
            <button type="button" class="close" ng-click="cancel()" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title"><?php echo get_phrase('Pay_student_fees');?></h3>
        </div>

        <?php echo form_open('admin/etranzact/do_update' , array('class' => 'form-horizontal validate','target' => '_top', 'enctype' => 'multipart/form-data'));?>
                <div class="modal-body" ng-repeat="item in etti">
                 
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Reg_no');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="serial" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" ng-model="item.customer_id">
                        </div>
                    </div>
    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Full_name');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" ng-model="item.fullname" name="fullname" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('Receipt_NO.');?></label>

                        <div class="col-sm-5">
                            <input type="text" ng-model="item.receipt_no" required min="20" class="form-control" name="receipt_no" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('Confirmation_no.');?></label>

                        <div class="col-sm-5">
                            <input type="text" ng-model="item.confirm_code" required min="20" class="form-control" name="CONFIRMATION_NO" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('Description.');?></label>

                        <div class="col-sm-5">
                            <input type="text" ng-model="item.description" required min="20" class="form-control" name="descr" />
                        </div>
                    </div>
                            <input type=hidden name = 'TERMINAL_ID' value='2140214016'>
                    <div class="form-group">
                       <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('_session');?></label>
                        <div class="col-sm-5">
                            <select id="session" name="session" class="form-control" ng-model="item.session">
                            <option>{{item.session}}</option>
                            <option>2010/2011</option>
                            <option>2011/2012</option>
                            <option>2012/2013</option>
                            <option>2013/2014</option>
                           </select>
                        </div>
                    </div>
                           
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Prog_type');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="prog_type" ng-model="item.prog_type" >
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="address" ng-model="item.address" >
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="phone" ng-model="item.phone" >
                        </div> 
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Dept');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="dept" ng-model="item.dept" >
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('level');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="level" ng-model="item.level">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('Edited By');?></label>
                        
                        <div class="col-sm-5">
                            <input type="text" class="form-control" readonly id="author" name="i" value='<?php echo $this->session->userdata("name");?>'>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('Entry Date');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" readonly id="edate" name="insert_date" value="<?php echo date('Y-m-d');?>" >
                        </div>
                    </div>
        </div>
        <?php echo form_close();?>
                    
        <div class="modal-footer">
            <button class="btn btn-primary" data-ng-click="proceed()">SUBMIT</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>
</div>
       
<div ng-controller="ModaleCtrl">
    <script type="text/ng-template" id="myModalDelete.html">
        <div class="modal-header">
            <button type="button" class="close" ng-click="cancel()" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" style="text-align:center;">Are you sure to delete this information ?</h4>
        </div>        
        <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
            <button class="btn btn-danger" data-ng-click="proceed(item.id)">Delete</button>
            <button class="btn btn-info" ng-click="cancel()">Cancel</button>
        </div> 
    </script>
</div> 

            </div>
        </div>
	   </div>
	  </div>
    </div>
</div>

