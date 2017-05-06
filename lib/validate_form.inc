<noscript>
<p><strong><font color="#FF0000"><big>Warning: </big>Your Internet Browser has JavaScript
switched off or is an older browser.&nbsp; You will not be able to complete this
form.&nbsp; Please switch on JavaScript or return with a newer browser. </font></strong></p>
</noscript>

<script LANGUAGE="javaScript">
<!--


function validate_login_form()
{

 with (document.login_frm)
 {
  var saveit = true;
  if (username.value.length < 4)
  {
   alert ("Username too short.  The username must be at least 4 characters in length.");
   username.focus();
   username.select();
   saveit = false;
  }
  if ((password.value.length < 4) && saveit)
  {
   alert ("Password too short.  The password must be at least 4 characters in length.");
   password.focus();
   password.select();
   saveit = false;
  }
  if ((fswords(username.value)) && saveit)
  {
   alert ("The username contains swear words.  Please change it you silly person!");
   username.focus();
   username.select();
   saveit = false;
  }
  if ((fswords(password.value)) && saveit)
  {
   alert ("The password contains swear words.  Please change it you silly person!");
   password.focus();
   password.select();
   saveit = false;
  }
  else if (saveit) submit();
 }
}
swords = new Array()
swords [0] = "fuck"
swords [1] = "shit"
swords [2] = "bastard"
swords [3] = "wank"
swords [4] = "arse"
swords [5] = "bitch"
swords [6] = "cunt"
function fswords(theword)
{
 thereturn=false;
 theword = theword.toLowerCase();
 for (i=0; i < swords.length; i++) 
 {   
  testit=theword.indexOf(swords[i],0);
  //alert(swords[i]+ " testit ="+testit)
  if (testit > -1) thereturn=true;
 }
 return thereturn
}

//--------------------------------------->


function entry_form_item_got_focus()
{
	
	with (document.forms["user_entry"])
	{add.value="";}
}


function validate_user_entry_form()
{
	//	var saveit = true;
	with (document.forms["user_entry"])
	{
			var atpos=email.value.indexOf("@");
			var dotpos=email.value.lastIndexOf(".");

			if (idsr.value == ""  && cat.value=="EMPLOYEE" )
			{
			alert("Pleas Enter Your Employee no.");
			idsr.focus();
			idsr.select();
			return false;
			}	
			if (idsr.value == ""  && cat.value=="STUDENT" )
			{
			alert("Pleas Enter Your School Registration no.");
			idsr.focus();
			idsr.select();
			return false;
			}			
			if (name.value=="")
			{
				alert ("Please Enter your Name");
				name.focus();
				name.select();
			    return false;
			}
			if (fname.value=="")
			{
   		alert ("Your Father's Name required please");
   		fname.focus();
   		fname.select();
			return false;
			}
			if(phone.value=="" )
			{
		alert("Please Enter Mobile Numbers");
   		phone.focus();
   		phone.select();
		return false;
			}

			if(isNaN(phone.value ))
			{
		alert("Please Enter Only digites");
   		phone.focus();
   		phone.select();
			return false;
			}
	
	 if(phone.value.length != 10 )
	{
		alert("Please Enter 10 digites");
   		phone.focus();
   		phone.select();
		return false;
	}
	 if(email.value == "" )
	{
		alert("Please Enter Your E-mail");
   		email.focus();
   		email.select();	
		return false;
	}
	
	 if(email.value.indexOf("@")<1 )
	{
		alert("Please Enter Your Prepar E-mail @");
   		email.focus();
   		email.select();
		return false;
	}
	
	 if(email.value.indexOf(".")<1)
	{
		alert("Please Enter Your Prepar E-mail .(com|in|org|co)");
   		email.focus();
   		email.select();
		return false;
	}
	 if ((atpos<1 || dotpos<atpos+2 || dotpos+2>=email.value.length) )
		{
		alert("Not a valid e-mail address");
		email.focus();
   		email.select();
		saveit = false;
		return false;
		}
	
	 if(add.value=="" )
	{
		alert("Your address is required please");
   		add.focus();
   		add.select();
		return false;
	}
   if(pass.value == "" )
	{
		alert("Pleas Enter Your desired Password");
   		pass.focus();
   		pass.select();
	return false;        
	}
        
	 if (pass.value.length < 4 )
  	{
   		alert ("Password too short.  The password must be at least 4 characters in length.");
   		pass.focus();
   		pass.select();
		return false;
	}
	 if(pass.value != conf_pass.value)
	{
		alert("Password not confirmed.... Pleas Enter same Password as above");
   		conf_pass.focus();
   		conf_pass.select();
		return false;        
	}
   }
 
}



function validate_change_pass_form()
{
   with (document.change_pass_form)
   {	
  	var saveit = true;
	if(cur_pass.value == "" && saveit )
	{
		alert("Please Enter Your current password");
		cur_pass.focus();
   		cur_pass.select();
		saveit= false;
	}
	if(cur_pass.value.length < 4 && saveit )
	{
		alert("Please Enter 4 or more characters");
		cur_pass.focus();
   		cur_pass.select();
		saveit= false
	}
	if(new_pass.value.length < 4 && saveit)
	{
		alert("Please Enter 4 or more characters as new password");
		new_pass.focus();
   		new_pass.select();
		saveit= false
	}
	
	if((conf_pass.value != new_pass.value) && saveit )
	{
		alert("Password Confermation failed......");
		conf_pass.focus();
   		conf_pass.select();
		saveit= false
	}
	
	return saveit;

   }

}

</script>
