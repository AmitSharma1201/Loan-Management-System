<?php
			
			if(isset($_SESSION['user_type']))
			{
			$user_type=$_SESSION['user_type'];
						$login_id=$_SESSION['login_id'];
			}
			else{
			$user_type = "client";
			$user_type = $_SESSION['user_type'];
			$client = $_SESSION['client'];
			};
			
			

  echo"<div class='panel panel-$theme'>
                        <div class='panel-heading'> $user_type Menu</div>
                    </div> ";
						
						
						
echo" <ul>";

if($user_type=="Admin")
{
echo "<li> <a href='newemployee.php'>Staff Registeration</a></li>
<li> <a href='viewemployee.php'>View My Staff</a></li>
<li> <a href='viewclient.php'>My Clients</a></li>
<li> <a href='manager_approval.php'>MANAGER APPROVAL</a></li>
<li> <a href='approved_loans.php'>APPROVED LOANS</a></li>
<li> <a href='recieve_emi.php'>EMI</a></li>



";
	
}
else if($user_type=="staff")
{
echo "<li> <a href='getnewgrouprequest.php'>New Group Request</a>
</li>";

}
else if($user_type=="Client")
{
echo"
<li> <a href='clientgroup.php'> client group</a></li>
<li> <a href='request_to_join.php'> group request</a></li>

<li> <a href='loanstatus.php'> Loan Status</a></li>	
<li> <a href='findmydocuments.php'>Find my document</a></li>";	

	
}
if($user_type!="")
echo "<li> <a href='logout.php'> Logout</a></li>";
echo "</ul>";						
						
						
?>
									
