<?php

$server = "unomedios.com.ar";  //this is the LDAP server you're connecting with
$ds = ldap_connect("ldap://$server", 389); //always connect securely via LDAPS when possible

ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);

$dn = "CN=Javier Alberto Tassi,OU=UNO MEDIOS S.A.,OU=UnoMedios S.A.,OU=Medios,DC=unomedios,DC=com,DC=ar";
$pass = 'Aa12162389"';
$ldapbind = ldap_bind($ds, $dn, $pass); //this is the point we are authenticating

$dn = "cn=Medios,dc=unomedios,dc=com,dc=ar"; //very important: in which part of your database are you looking
$filter = "cn=*"; //don't filter anyone out (every user has a uid)
$sr = ldap_search($ds, $dn, $filter) or die ("bummer"); //define your search scope

$results = ldap_get_entries($ds, $sr); //here we are pulling the actual entries from the search we just defined
var_dump($results); //will give you all results is array form. 

?>