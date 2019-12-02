<?php

/* 
* Unix Tool <-> Http
*
* Description: a program that converts HTTP REQUESTS into Bash calls
*
*/
class UnixFileMode {
	private $unixMode = 0;
	public function __construct(array $phpStatArray) {$this->unixMode = $this->getUnixMode($phpStatArray); }
	public function getUnixMode(array $phpStatArray):int { return $phpStatArray["mode"] & 1023; }
	public function allowsUserOwnerRead()     { return (($this->unixMode >> 6 & 7) >> 2 & 1) == true;}
	public function allowsUserOwnerWrite()    { return (($this->unixMode >> 6 & 7) >> 1 & 1) == true;}
	public function allowsUserOwnerExecute()  { return (($this->unixMode >> 6 & 7) >> 0 & 1) == true;}
	
	public function allowsGroupOwnerRead()    { return (($this->unixMode >> 3 & 7) >> 2 & 1) == true;}
	public function allowsGroupOwnerWrite()   { return (($this->unixMode >> 3 & 7) >> 1 & 1) == true;}
	public function allowsGroupOwnerExecute() { return (($this->unixMode >> 3 & 7) >> 0 & 1) == true;}
	
	public function allowsEverybodyRead()     { return (($this->unixMode >> 0 & 7) >> 2 & 1) == true;}
	public function allowsEverybodyWrite()    { return (($this->unixMode >> 0 & 7) >> 1 & 1) == true;}
	public function allowsEverybodyExecute()  { return (($this->unixMode >> 0 & 7) >> 0 & 1) == true;}
}


header("Content-type: text/plain"); 
//print_r($_SERVER);

$requested_file = ".".$_SERVER["REQUEST_URI"];

if (file_exists($requested_file)) {
	$mode = new UnixFileMode(stat($requested_file));
	if ($mode->allowsUserOwnerRead())     echo "User owner is allowed to Read.\n";     else echo "User owner cannot Read.\n";
	if ($mode->allowsUserOwnerWrite())    echo "User owner is allowed to Write.\n";    else echo "User owner cannot Write.\n";
	if ($mode->allowsUserOwnerExecute())  echo "User owner is allowed to Execute.\n";  else echo "User owner cannot Execute.\n";
	
	if ($mode->allowsGroupOwnerRead())    echo "Group owner is allowed to Read.\n";    else echo "Group owner cannot Read.\n";
	if ($mode->allowsGroupOwnerWrite())   echo "Group owner is allowed to Write.\n";   else echo "Group owner cannot Write.\n";
	if ($mode->allowsGroupOwnerExecute()) echo "Group owner is allowed to Execute.\n"; else echo "Group owner cannot Execute.\n";
	
	if ($mode->allowsEverybodyRead())     echo "Everybody is allowed to Read.\n";      else echo "Everybody cannot Read.\n";
	if ($mode->allowsEverybodyWrite())    echo "Everybody is allowed to Write.\n";     else echo "Everybody cannot Write.\n";
	if ($mode->allowsEverybodyExecute())  echo "Everybody is allowed to Execute.\n";   else echo "Everybody cannot Execute.\n";
} else {
	echo "Requested file does not exists.";
}
