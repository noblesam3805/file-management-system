<hr />
                 <!--BLOCK SECTION -->
                 <div class="row">
                    <div class="col-lg-12">
                        <div style="text-align: center;">

                          <!--  <a class="quick-btn" href="customer_login.php">
                                <i class="icon-check icon-2x"></i>
                                <span> Account</span>
                                <span class="label label-danger">2</span>
                            </a> -->

                            <a class="quick-btn" href="deposit.php">
                                <i class="icon-envelope icon-2x"></i>
                                <span>Deposit</span>
                                <span class="label label-success">   <?php 
										 
										$query1 = mysql_query("select count(*) as exp from transaction where transaction_type='deposit'") or die(mysql_error());
										//$result = mysql_result($query,0);
										while($results1=mysql_fetch_array($query1))
										{
											echo $results1["exp"];
										 }?></span>
                            </a>
                            <a class="quick-btn" href="transfer.php">
                                <i class="icon-signal icon-2x"></i>
                                <span>Transfer</span>
                                <span class="label label-warning"><?php 
										 
										$query1 = mysql_query("select count(*) as exp from transaction where transaction_type='transfer'") or die(mysql_error());
										//$result = mysql_result($query,0);
										while($results1=mysql_fetch_array($query1))
										{
											echo $results1["exp"];
										 }?></span>
                            </a>
                            <a class="quick-btn" href="withdraw.php">
                                <i class="icon-external-link icon-2x"></i>
                                <span>Withdrawal</span>
                                <span class="label btn-metis-2"><?php 
										 
										$query1 = mysql_query("select count(*) as exp from transaction where transaction_type='widthraw'") or die(mysql_error());
										//$result = mysql_result($query,0);
										while($results1=mysql_fetch_array($query1))
										{
											echo $results1["exp"];
										 }?></span>
                            </a>
                            <a class="quick-btn" href="balance.php">
                                <i class="icon-lemon icon-2x"></i>
                                <span>Balance</span>
                                <span class="label btn-metis-4">107</span>
                            </a>
                            <a class="quick-btn" href="list.php?data=customer">
                                <i class="icon-bolt icon-2x"></i>
                                <span>Users</span>
                                <span class="label label-default"><?php 
										 
										$query1 = mysql_query("select count(*) as exp from admin") or die(mysql_error());
										//$result = mysql_result($query,0);
										while($results1=mysql_fetch_array($query1))
										{
											echo $results1["exp"];
										 }?></span>
                            </a>



                        </div>

                    </div>

                </div>
                  <!--END BLOCK SECTION -->
                <hr />
