<?php 
ob_start();
session_start();
include 'connection.php';
include '../des.php';

if(isset($_POST['courseselect'])){
	$course_id=$_GET['id'];
	$course=$db->prepare("SELECT * FROM courses WHERE course_id=:id");
	$course->execute(array(
		'id'=>$course_id
	));
	$courseselect=$course->fetch(PDO::FETCH_ASSOC);
	$course_name=$courseselect['course_name'];
	$course_code=$courseselect['course_code'];
	$user_mail=$_SESSION['user_mail'];
	$user=$db->prepare("SELECT * FROM users WHERE user_mail=:mail");
	$user->execute(array(
		'mail'=>$user_mail
	));
	$userselect=$user->fetch(PDO::FETCH_ASSOC);
	$user_id=$userselect['user_id'];
	//IF ITS ALREADY IN DATABASE DONT INSERT IN TABLE
	$check=$db->prepare("SELECT * FROM selectedcourses WHERE course_code=:code and user_id=:id");
	$check->execute(array(
		'code'=>$course_code,
		'id'=>$user_id
	));
	$checking=$check->rowCount();
	if($checking==0){
	
		$slctdcourses=$db->prepare("INSERT INTO selectedcourses SET
			user_id=:user_id,
			course_name=:course_name,
			course_code=:course_code
		");
		$insert=$slctdcourses->execute(array(
			'user_id'=>$user_id,
			'course_name'=>$course_name,
			'course_code'=>$course_code
		));
		if($insert){
			header("Location:../index.php?select=ok");
		}else{
			header("Location:../index.php?select=no");
		}
	}else{
		header("Location:../index.php?already");
	}
}

if(isset($_POST['removecourse'])){
	$id=$_GET['id'];
	$course=$db->prepare("SELECT * FROM courses WHERE course_id=:id");
	$course->execute(array(
		'id'=>$id
	));
	$getcourse=$course->fetch(PDO::FETCH_ASSOC);
	$course_code=$getcourse['course_code'];
	$user_mail=$_SESSION['user_mail'];
	$user=$db->prepare("SELECT * FROM users WHERE user_mail=:mail");
	$user->execute(array(
		'mail'=>$user_mail
	));
	$userselect=$user->fetch(PDO::FETCH_ASSOC);
	$user_id=$userselect['user_id'];
	$removecourse=$db->prepare("DELETE FROM selectedcourses WHERE course_code=:code and user_id=:id");
	$delete=$removecourse->execute(array(
		'code'=>$course_code,
		'id'=>$user_id
	));
	if($delete){
		header("Location:../index.php?delete=ok");
	}else{
		header("Location:../index.php?delete=no");
	}
	
}
if(isset($_POST['usersignin'])){
	$mail=$_POST['user_mail'];
	$pass=$_POST['user_pass'];
	$key=$db->prepare("SELECT * FROM deskey WHERE id=:id");
	$key->execute(array(
		'id'=>1
	));
	$getkey=$key->fetch(PDO::FETCH_ASSOC);
	$key=$getkey['deskey'];
	$iv=$getkey['iv'];
	$des = new DES($key, 'DES-CBC', DES::OUTPUT_BASE64, $iv);
	$passw= $des->encrypt($pass);
	$userselect=$db->prepare("SELECT * FROM users WHERE user_mail=:mail and user_password=:pass");
	$userselect->execute(array(
		'mail'=>$mail,
		'pass'=>$passw
	));
	$a=$userselect->rowCount();
	if($a==1){
		$_SESSION['user_mail']=$mail;
		$select=$userselect->fetch(PDO::FETCH_ASSOC);
		$duty=$select['user_duty'];
		if($duty==0){												//STUDENT DUTY=0
			header("Location:../index.php?login=ok");				//ADVISOR DUTY=1	
		}															//VC DUTY =2
		else if($duty==1){											//DEAN DUTY=3
			header("Location:../advisor.php?login=ok");				//RECTOR DUTY=4
		}															//ADMIN DUTY=5
		else if($duty==2){
			header("Location:../vicechair.php?login=ok");
		}
		else if($duty==3){
			header("Location:../dean.php?login=ok");
		}
		else if($duty==4){
			header("Location:../rector.php?login=ok");
		}
		else if($duty==5){
			header("Location:../admin.php?login=ok");
		}
		else{
			header("Location:../login.php?login=no");
		}
		
	}else{
		header("Location:../login.php?login=no");
	}

}	
if(isset($_POST['courseconfirm'])){
	$user_id=$_GET['user_id'];
	//$courses=$_POST['courses'];
	//$crs=implode(',', $courses);
	//$number=count($courses);
	//foreach($courses as &$course){
		//echo $course."<br>";
	$course=$db->prepare("UPDATE selectedcourses SET
		course_confirm=:course_confirm WHERE user_id={$_GET['user_id']}
		");
	$confirm=$course->execute(array(
		'course_confirm'=>1
	)); 
	//}
	if($confirm){
		header("Location:../vicechair.php");
	}else{
		header("Location:../vicechair.php");
	}
}
if(isset($_POST['courseconfirmadvisor'])){
	echo "string";
	$user_id=$_GET['user_id'];
	//$courses=$_POST['courses'];
	//$crs=implode(',', $courses);
	//$number=count($courses);
	//foreach($courses as &$course){
		//echo $course."<br>";
	$course=$db->prepare("UPDATE selectedcourses SET
		course_confirm=:course_confirm WHERE user_id={$_GET['user_id']}
		");
	$confirm=$course->execute(array(
		'course_confirm'=>1
	)); 
	//}
	if($confirm){
		header("Location:../advisor.php");
	}else{
		header("Location:../advisor.php");
	}
}
if(isset($_POST['assignadvisor'])){
	$advisor_id=$_POST['slct'];
	$student_id=$_GET['userid'];
	$advisor=$db->prepare("SELECT * FROM users WHERE user_id=:id");
	$advisor->execute(array(
		'id'=>$advisor_id
	));
	$selectadvisor=$advisor->fetch(PDO::FETCH_ASSOC);
	$iv = 'iv123456'; //initialization vector
	$key=$db->prepare("SELECT * FROM deskey WHERE id=:id");
	$key->execute(array(
		'id'=>1
	));
	$getkey=$key->fetch(PDO::FETCH_ASSOC);
	$key=$getkey['deskey'];
	$des = new DES($key, 'DES-CBC', DES::OUTPUT_BASE64, $iv);
	echo $advisor=$des->decrypt($selectadvisor['user_name'])." ".$des->decrypt($selectadvisor['user_surname']);
	//ASSIGN ADVISOR
	
	$assign=$db->prepare("UPDATE users SET
		student_advisor=:student_advisor WHERE user_id={$_GET['userid']}
		");
	$insert=$assign->execute(array(
		'student_advisor'=>$advisor
	));
	if($insert){
		header("Location:../assignadvisor.php?assign=ok");
	}else{
		header("Location:../assignadvisor.php?assign=no");
	}
	
}
if(isset($_POST['updatecourse'])){
	$id=$_GET['course_id'];
	$courseinfo=$db->prepare("UPDATE courses SET
		course_name=:course_name,
		course_code=:course_code,
		course_teacher=:course_teacher,
		course_credit=:course_credit,
		course_description=:course_description WHERE course_id={$_GET['course_id']}
	 ");
	$update=$courseinfo->execute(array(
		'course_name' => $_POST['course_name'],
		'course_code' => $_POST['course_code'],
		'course_teacher' => $_POST['course_teacher'],
		'course_credit' => $_POST['course_credit'],
		'course_description' => $_POST['course_description'],
	));
	if($update){
		header("Location:../course-edit.php?course_id=$id&update=ok");
	}else{
		header("Location:../course-edit.php?course_id=$id&update=no");
	}

}
if(isset($_POST['deletecourse'])){
	$id=$_GET['course_id'];
	$deleteinfo=$db->prepare("DELETE FROM courses WHERE course_id=:id");
	$delete=$deleteinfo->execute(array(
		'id'=>$id
	));
	if($delete){
		header("Location:../course-details.php?delete=ok");
	}else{
		header("Location:../course-edit.php?delete=no");
	}
}
if(isset($_POST['assignrole'])){
	echo $duty=$_POST['duty'];
	if($duty==2){
		echo $newrole='Vicechair';
	}else if($duty==3){
		echo $newrole='Dean';
	}else if($duty==4){
		echo $newrole='Rector';
	}
	echo $user_id=$_GET['user_id'];
	$role=$db->prepare("UPDATE users SET
		user_role=:user_role,
		user_duty=:user_duty WHERE user_id=$user_id
		");
	$assign=$role->execute(array(
		'user_role'=>$newrole,
		'user_duty'=>$duty
	));
	if($assign){
		header("Location:../roles.php?assign=ok&id=$user_id");
	}else{
		header("Location:../roles.php?assign=no&id=$user_id");
	}
}

//UPDATE KEY WITH DES ENCRYPTION
if(isset($_POST['updatekey'])){
	$newkey=$_POST['key'];
	$iv = 'iv123456'; //initialization vector
	// fetch old key for decryption
	$key=$db->prepare("SELECT * FROM deskey WHERE id=:id");
	$key->execute(array(
		'id'=>1
	));
	$getkey=$key->fetch(PDO::FETCH_ASSOC);
	$oldkey=$getkey['deskey'];

	//LOOP
	$data=$db->prepare("SELECT * FROM users");// fetch all encrypted data
	$data->execute();
	while($getuser=$data->fetch(PDO::FETCH_ASSOC)){
	//$getuser=$data->fetch(PDO::FETCH_ASSOC);
	$des = new DES($oldkey, 'DES-CBC', DES::OUTPUT_BASE64, $iv);
	$plainpass=$des->decrypt($getuser['user_password']);//plain text password
	$plainname=$des->decrypt($getuser['user_name']);
	$plainsurname=$des->decrypt($getuser['user_surname']); 
	$user_id=$getuser['user_id'];
	//Encrypt data again according to new key
	$des = new DES($newkey, 'DES-CBC', DES::OUTPUT_BASE64, $iv); //call DES again with new key
	echo $cipherpass=$des->encrypt($plainpass);
	echo $ciphername=$des->encrypt($plainname);
	echo $ciphersurname=$des->encrypt($plainsurname);

		//SILINECEK BOLUM DENEME AMACLI
	$encrypt=$db->prepare("UPDATE users SET
		user_password=:password,
		user_name=:name,
		user_surname=:surname WHERE user_id=$user_id
		");
	$newencrypt=$encrypt->execute(array(
		'password'=>$cipherpass,
		'name'=>$ciphername,
		'surname'=>$ciphersurname
	));
	}
	
	//Store encrypted data
	/*
	$encrypt=$db->prepare("UPDATE users SET user_password=:password and user_name=:name and user_surname=:surname WHERE user_id=$user_id");
	$encrypt->execute(array(
		'password' => $cipherpass,
		'name'=>$ciphername,
		'surname'=>$ciphersurname
	));
	} */
	//Store newkey in Database
	$nkeystore=$db->prepare("UPDATE deskey SET
		deskey=:deskey WHERE id=1
		");
	$update=$nkeystore->execute(array(
		'deskey'=>$newkey
	)); 
	if($update){
		header("Location:../updatekey.php?update=ok");
	}else{
		header("Location:../updatekey.php?update=no");
	} 
}

 ?>