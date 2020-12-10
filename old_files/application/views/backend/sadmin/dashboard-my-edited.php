<div class="row-md-12">
        <div class="col-xs-3">
            
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-credit-card"></i></div>
                    <!--div class="num" data-start="0" data-end="<?php echo $this->db->count_all('etranzact_pay');?>"--> 
                    <!--div class="num" data-start="0" id='etti' data-end="<?php echo $query;?>"-->   
                    <div class="num" data-start="0" id='etti' data-end=""
                            data-postfix="" data-duration="1500" data-delay="0">0</div>       
                    
                    <h3><?php echo get_phrase('Etranzact Payment');?></h3>
                   <p>Total Payment</p>
                   
                </div>

                
            </div>
			
			<div class="col-xs-3">
            
                <div class="tile-stats tile-blue">
                    <div class="icon"><i class="entypo-credit-card"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('manual_etranzact');?>" 
                            data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('Manual Payment');?></h3>
                   <p>Total Payment</p>
                   
                </div>

                
            </div> 


            <div class="col-xs-3">
            
                <div class="tile-stats tile-orange">
                    <div class="icon"><i class="entypo-credit-card"></i></div>
                    <!--div class="num" data-start="0" data-end="<?php echo $this->db->count_all('counter');?>" -->
                    <div class="num" data-start="0" id='unpaid' data-end="<?php echo $total;?>"
                            data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('Unverified fees');?></h3>
                   <p>Total Students</p>
                   
                </div>

                
            </div>
            <div class="col-xs-3">
            
                <div class="tile-stats tile-orange">
                    <div class="icon"><i class="entypo-credit-card"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('counter');?>" 
                            data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('Scratch Card');?></h3>
                   <p>Total Used</p>
                   
                </div>

                
            </div>
                
        </div-->
    <div class="col-md-8">
        <div class="row">
            <!-- CALENDAR-->
            <div class="col-md-12 col-xs-12">    
                <div class="panel panel-primary " data-collapsed="0">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <i class="fa fa-calendar"></i>
                            <?php echo get_phrase('event_schedule');?>
                        </div>
                    </div>
                    <div class="panel-body" style="padding:0px;">
                        <div class="calendar-env">
                            <div class="calendar-body">
                                <div id="notice_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
            
                <div class="tile-stats tile-red">
                    <div class="icon"><i class="fa fa-group"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('student');?>" 
                            data-postfix="" data-duration="1500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('student');?></h3>
                   <p>Total students</p>
                   
                </div>

                
            </div>
            <div class="col-md-12">
            
                <div class="tile-stats tile-green">
                    <div class="icon"><i class="entypo-users"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('teacher');?>" 
                            data-postfix="" data-duration="800" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('teacher');?></h3>
                   <p>Total staff</p>
                </div>
                
            </div>
            <?php
            /*<!--div class="col-md-12">
            
                <div class="tile-stats tile-aqua">
                    <div class="icon"><i class="entypo-user"></i></div>
                    <div class="num" data-start="0" data-end="<?php echo $this->db->count_all('parent');?>" 
                            data-postfix="" data-duration="500" data-delay="0">0</div>
                    
                    <h3><?php echo get_phrase('parent');?></h3>
                   <p>Total parents</p>
                </div>
                
            </div-->*/
            ?>
            
        </div>
    </div>