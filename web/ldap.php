<?php
	//Error Checking
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	
	//Set User domain extention
	$LDAPUserDomain = "@unomedios.com.ar";  //Needs the @, but not always the same as the LDAP server domain
	?><form name="input" action="ldap.php" method="post">
		Username: <input type="text" name="u"> <?php echo $LDAPUserDomain;?><br />
		Password: <input type="password" name="p">
		<input type="submit" value="Submit">
	</form><?php
	if(isset($_POST['p'])){
	/**************************************************
	 Bind to an Active Directory LDAP server and look
	 something up.
	 ***************************************************/
	$SearchFor="samaccountname";		//What string do you want to find?
	$SearchField="samaccountname";			//In what Active Directory field do you want to search for the string?
	$LDAPHost = "unomedios.com.ar";		//Your LDAP server DNS Name or IP Address
	$dn = "DC=unomedios,DC=com,DC=ar";		//Put your Base DN here
	$LDAPUser = $_POST['u'];		//A valid Active Directory login
	$LDAPUserPassword = $_POST['p'];
	$LDAPFieldsToFind = array("*");		//Search Felids, Wildcard Supported for returning all values

	$cnx = ldap_connect($LDAPHost) or die("Could not connect to LDAP");
	ldap_set_option($cnx, LDAP_OPT_PROTOCOL_VERSION, 3);	//Set the LDAP Protocol used by your AD service
	ldap_set_option($cnx, LDAP_OPT_REFERRALS, 0);		//This was necessary for my AD to do anything
	ldap_bind($cnx,$LDAPUser.$LDAPUserDomain,$LDAPUserPassword) or die("Could not bind to LDAP");
	error_reporting (E_ALL ^ E_NOTICE);			//Suppress some unnecessary messages

	$filter="($SearchField=$SearchFor*)";	//Wildcard is * Remove it if you want an exact match
	$sr=ldap_search($cnx, $dn, $filter, $LDAPFieldsToFind);
	$info = ldap_get_entries($cnx, $sr);
	
	echo"<pre>";
	for ($x=0; $x<$info["count"]; $x++) {
		
		//print_r($info[$x]);
		echo "Name: " .$info[$x]['cn'][0]."<br/>";
		echo "Windows Login: " .$info[$x]['samaccountname'][0]."<br/>";
		echo "Extention: " .$info[$x]['telephonenumber'][0]."<br/>";
		echo "Email: " .$info[$x]['mail'][0]."<br/>";
		echo "Office: " .$info[$x]['physicaldeliveryofficename'][0]."<br/>";
		echo "Main System UID: " .$info[$x]['description'][0]."<br/>";
		echo "Job Title: " .$info[$x]['title'][0]."<br/>";
		echo "Department: " .$info[$x]['department'][0]."<br/>";
		$info[$x]['manager'][0] = explode(",",$info[$x]['manager'][0]);
		$info[$x]['manager'][0] = str_replace('CN=','',$info[$x]['manager'][0][0]);
		echo "Line Manager: " .$info[$x]['manager'][0]."<br/>";
		echo "Company: " .$info[$x]['company'][0]."<br/>";
		
		if($info[$x]['memberof']['count'] != 0){
			foreach($info[$x]['memberof'] as $key){
				$key = explode(",",$key);
				$key = str_replace('CN=','',$key[0]);
				echo "Member of: " .$key."<br/>";
			}
		}
		echo "\n\n";
	}
	echo"</pre>";
	
	if ($x==0) {
		print "Oops, was not found. Please try again.\n";
	}
}
?>