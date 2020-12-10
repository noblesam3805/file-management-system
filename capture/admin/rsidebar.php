<!-- RIGHT STRIP  SECTION -->
        <div id="right">

            
            <div class="well well-small">
                <ul class="list-unstyled">
                  
                    <li>Users &nbsp; : <span><?php 
										 
										$query1 = mysql_query("select count(*) as exp from admin") or die(mysql_error());
										//$result = mysql_result($query,0);
										while($results1=mysql_fetch_array($query1))
										{
											echo $results1["exp"];
										 }?></span></li>
                    <li>Customers &nbsp; : <span><?php 
										 
										$query1 = mysql_query("select count(*) as exp from customer") or die(mysql_error());
										//$result = mysql_result($query,0);
										while($results1=mysql_fetch_array($query1))
										{
											echo $results1["exp"];
										 }?></span></li>
                </ul>
            </div>
            
         
          
            
         

        </div>
         <!-- END RIGHT STRIP  SECTION -->