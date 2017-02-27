<?
//	$SessionName = session_name();

	session_name("security");
	session_start();
	if (isset($_SESSION['CurrentUserID'])) $CurrentUserID = $_SESSION['CurrentUserID']; else $CurrentUserID = "";
	if (isset($_SESSION['SecurityString'])) $GLOBALS["SECURITYSTRING"] = $_SESSION['SecurityString']; else $GLOBALS["SECURITYSTRING"] = "";

	$GLOBALS["CURRENTUSERID"] = $CurrentUserID;
	if ($CurrentUserID != "") {
		$sql = "select * from `user_roles` where `USERID`='".$CurrentUserID."'";
		if ($result = mysql_query($sql)) {
			while ($row = mysql_fetch_array($result)) {
				$GLOBALS["UR_ROLES"][$row["USERROLE"]] = "";
			}
		}
	}
?>

