function validation() {
	Fname=document.registration;
	
	if(Fname.hotel_name.value=='')
	{
		 alert('Please Enter Hotel Name');
		Fname.hotel_name.focus();
		return false;
	}
	
	if(Fname.hotel_address.value=='')
	{
		 alert('Please Enter Hotel Address');
		Fname.hotel_address.focus();
		return false;
	}
	
		if(Fname.location.value=='')
	{
		 alert('Please Enter Hotel Location');
		Fname.location.focus();
		return false;
	}
		if(Fname.no_room.value=='')
	{
		 alert('Please Enter No Of Room');
		Fname.no_room.focus();
		return false;
	}
	
		if(Fname.cpname.value=='')
	{
		 alert('Please Enter the Contact Person');
		Fname.cpname.focus();
		return false;
	}
		if(Fname.conno.value=='')
	{
		 alert('Please Enter the contact No');
		Fname.conno.focus();
		return false;
	}
	if(Fname.mobileno.value=='')
	{
		 alert('Please Enter the Mobile No');
		Fname.mobileno.focus();
		return false;
	}
	if(Fname.fax.value=='')
	{
		 alert('Please Enter the Fax No');
		Fname.fax.focus();
		return false;
	}
	
	if(Fname.email.value=='')
	{
		 alert('Please Enter the Email Address');
		Fname.email.focus();
		return false;
	}
	
	stre=Fname.email.value;
 if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(stre)))
 { 
		alert('Enter Valid E-mail Address')
		Fname.email.focus();
		Fname.email.value='';
		return false;
 }	
 
 if(Fname.website.value=='')
	{
		 alert('Please Enter the Website');
		Fname.website.focus();
		return false;
	}
 
 if(Fname.user_email.value=='')
	{
		 alert('Please Enter User Email Address');
		Fname.user_email.focus();
		return false;
	}
	
	stre=Fname.user_email.value;
 if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(stre)))
 { 
		alert('Enter Valid E-mail Address')
		Fname.user_email.focus();
		Fname.user_email.value='';
		return false;
 }	
 
  if(Fname.pass.value=='')
	{
		 alert('Please Enter the Password');
		Fname.pass.focus();
		return false;
	}


	
}

function car_validation() {
	Fname=document.registration;
	
	if(Fname.hotel_name.value=='')
	{
		 alert('Please Enter Agent Name');
		Fname.hotel_name.focus();
		return false;
	}
	
	if(Fname.hotel_address.value=='')
	{
		 alert('Please Enter Agent Address');
		Fname.hotel_address.focus();
		return false;
	}
	
		if(Fname.location.value=='')
	{
		 alert('Please Enter  Location');
		Fname.location.focus();
		return false;
	}
		/*if(Fname.no_room.value=='')
	{
		 alert('Please Enter No Of Room');
		Fname.no_room.focus();
		return false;
	}
	*/
		if(Fname.cpname.value=='')
	{
		 alert('Please Enter the Contact Person');
		Fname.cpname.focus();
		return false;
	}
		if(Fname.conno.value=='')
	{
		 alert('Please Enter the contact No');
		Fname.conno.focus();
		return false;
	}
	if(Fname.mobileno.value=='')
	{
		 alert('Please Enter the Mobile No');
		Fname.mobileno.focus();
		return false;
	}
	if(Fname.fax.value=='')
	{
		 alert('Please Enter the Fax No');
		Fname.fax.focus();
		return false;
	}
	
	if(Fname.email.value=='')
	{
		 alert('Please Enter the Email Address');
		Fname.email.focus();
		return false;
	}
	
	stre=Fname.email.value;
 if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(stre)))
 { 
		alert('Enter Valid E-mail Address')
		Fname.email.focus();
		Fname.email.value='';
		return false;
 }	
 
 if(Fname.website.value=='')
	{
		 alert('Please Enter the Website');
		Fname.website.focus();
		return false;
	}
 
 if(Fname.user_email.value=='')
	{
		 alert('Please Enter User Email Address');
		Fname.user_email.focus();
		return false;
	}
	
	stre=Fname.user_email.value;
 if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(stre)))
 { 
		alert('Enter Valid E-mail Address')
		Fname.user_email.focus();
		Fname.user_email.value='';
		return false;
 }	
 
  if(Fname.pass.value=='')
	{
		 alert('Please Enter the Password');
		Fname.pass.focus();
		return false;
	}


	
}


function GetXmlHttpObject()
{ 
	var objXMLHttp=null
	if (window.XMLHttpRequest)
	{
	objXMLHttp=new XMLHttpRequest()
	}
	else if (window.ActiveXObject)
	{
	objXMLHttp=new ActiveXObject("Microsoft.XMLHTTP")
	}
	return objXMLHttp
}

function getCity(cty) 
{//alert(cty);
state_xmlHttp=GetXmlHttpObject()
	if (state_xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	} 
	state_xmlHttp.onreadystatechange = function ()
	{ 
		if (state_xmlHttp.readyState==4) 
		{
			//alert(state_xmlHttp.responseText);
			if(state_xmlHttp.responseText)
			 {
				 // alert('Login Name Already exist');
				  document.getElementById('get_city_d').innerHTML=state_xmlHttp.responseText;
				  
			 }
			 
			
		}
	};
	
	
		var url = "packagecity/"+cty; 
	//alert(url)
	state_xmlHttp.open("POST", url); //make connection
	state_xmlHttp.send(null); 	
}
function getCity1(cty,host) 
{
	
	var myString = "http://"+host+"/tpd/admin/";
state_xmlHttp=GetXmlHttpObject()
	if (state_xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	} 
	state_xmlHttp.onreadystatechange = function ()
	{ 
		if (state_xmlHttp.readyState==4) 
		{
			//alert(state_xmlHttp.responseText);
			if(state_xmlHttp.responseText)
			 {
				 // alert('Login Name Already exist');
				  document.getElementById('city').innerHTML=state_xmlHttp.responseText;
				  
			 }
			 
			
		}
	};
	
	
		var url = myString+"index.php/holiday/packagecity/"+cty; 
		

	state_xmlHttp.open("POST", url); //make connection
	state_xmlHttp.send(null); 	
}
function get_package(str,status) 
{
	//alert(status);
   if ( status === undefined ) {
      status = 'Active';
   }
state_xmlHttp=GetXmlHttpObject()
	if (state_xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	} 
	state_xmlHttp.onreadystatechange = function ()
	{ 
	
		if (state_xmlHttp.readyState==4) 
		{
			
			if(state_xmlHttp.responseText)
			 {
				 // alert('Login Name Already exist');
				  document.getElementById('get_pack').innerHTML=state_xmlHttp.responseText;
				  
			 }

		}
	};
	var url = "packages/"+str+"/"+status; 
	//alert(url)
	state_xmlHttp.open("POST", url); //make connection
	state_xmlHttp.send(null); 	
}
function get_package1(str,host) 
{	
	if(str=='2')
	{
	 $('#holidaytype2').css('background','#cfcfcf'); 
	 $('#holidaytype1').css('background','#ececec');
	 $('#holiday_type').val('2');
	}
	if(str=='1')
	{
	$('#holiday_type').val('1');
	 $('#holidaytype1').css('background','#cfcfcf'); 
	 $('#holidaytype2').css('background','#ececec');
	}
	  
	var myString = "http://"+host+"/WDM/naxtravel/";
   if ( status === undefined ) {
      status = 'Active';
   }
state_xmlHttp=GetXmlHttpObject()
	if (state_xmlHttp==null)
	{
		alert ("Browser does not support HTTP Request")
		return
	} 
	state_xmlHttp.onreadystatechange = function ()
	{ 
	
		if (state_xmlHttp.readyState==4) 
		{
			
			if(state_xmlHttp.responseText)
			 {
				 // alert('Login Name Already exist');
				  document.getElementById('get_pack').innerHTML=state_xmlHttp.responseText;
				  
			 }

		}
	};
	
	
		var url = myString+"index.php/holiday/packages/"+str+"/"+status; 
		
	state_xmlHttp.open("POST", url); //make connection
	state_xmlHttp.send(null); 	
}


function pack_validation() {
	Fname=document.registration;
	
	if(Fname.holiday_type.value=='')
	{
		 alert('Please Enter Holiday Type');
		Fname.holiday_type.focus();
		return false;
	}
	
	if(Fname.pack_name.value=='')
	{
		 alert('Please Enter Package Name');
		Fname.pack_name.focus();
		return false;
	}
}



function hotel_validation() {
	Fname=document.registration;

	//txt=document.feedback;
	
	 var  radio_but=document.getElementById('holiday_type').value;
	// alert(radio_but)
	 //return false;
		myOption = -1;
	for (i=Fname.holiday_type.length-1; i > -1; i--) 
	 {
			if (Fname.holiday_type[i].checked)
			{
			myOption = i; i = -1;
	       }
	}
	
	// return false;
	if (myOption == -1)
	{
		alert("Please Select Holiday Type. ");
		return false;
	}
	 if(myOption==1){
		 
		 
		 
		//  var  radio_but1=document.getElementById('holiday_type').value;
	// alert(radio_but)
	 //return false;
/*		myOption1 = -1;
	for (i=Fname.dome_pack.length-1; i > -1; i--) 
	 {
			if (Fname.dome_pack[i].checked)
			{
			myOption1 = i; i = -1;
	       }
	}
	
	// return false;
	if (myOption1 == -1)
	{
		alert("Please Select Domestic Holiday Type. ");
		return false;
	}
		*/ 
		 
		 
	 }
	
		var opt = document.registration.elements["holiday_category"].options;
		var x, len = opt.length;
		for (x=0; x<len; x++) {
		if(opt[x].selected) break;
		}//alert(x);alert(len);
		if(x<len) {
		//alert('');
		//return false;
		if(x==0){
			
           alert('Please Select Holiday Package Category');	
		   return false;
		}
		} 
		else {
			
           alert('Please Select Holiday Package Category');	
		   return false;}
	
	
	/*if(Fname.holiday_title.value=='')
	{
		 alert('Please Select Holiday Package Category');
		Fname.holiday_title.focus();
		return false;
	}
	*/
		if(Fname.package_title.value=='')
	{
		 alert('Please Select Holiday Package title');
		Fname.package_title.focus();
		return false;
	}
	
	
	
		var opt = document.registration.elements["desti[]"].options;
		var x, len = opt.length;
		for (x=0; x<len; ++x) {
		if(opt[x].selected) break;
		}
		if(x<len) {
		//alert('');
		//return false;
		} 
		else {
			
           alert('Please Select Holiday Destination');	
		   return false;}
	
	
	
	if(Fname.duration.value=='')
	{
		 alert('Please Enter Duration');
		Fname.duration.focus();
		return false;
	}
	
	
/*	if(Fname.datepicker.value=='')
	{
	 alert('Please Enter the Start Date');
	Fname.datepicker.focus();
	return false;
	}
	if(Fname.datepicker1.value=='')
	{
		 alert('Please Enter End Date');
		Fname.datepicker1.focus();
		return false;
	}
	*/
	/*if(Fname.datepicker1.value!='' && Fname.datepicker.value!=''){
	 if (CompareDates(Fname.datepicker1.value,Fname.datepicker.value))
            {
                alert("End - Date cannot be greater than From-in Date"); 
                Fname.datepicker1.focus();        
                return false; 
            }
	}*/
	
	var value = tinyMCE.get('description').getContent();
            if (value == "") {
                alert('Please Enter the Description');
				return false;
            }
			
		var value = tinyMCE.get('highlight').getContent();
            if (value == "") {
                alert('Please Enter Highlights');
				return false;
            }
			
				var value = tinyMCE.get('iternery').getContent();
            if (value == "") {
                alert('Please Enter Itinery');
				return false;
            }
			
				var value = tinyMCE.get('hotel_desc').getContent();
            if (value == "") {
                alert('Please Enter hotel description');
				return false;
            }		

			var opt = document.registration.elements["hotel_type[]"].options;
		var x, len = opt.length;
		for (x=0; x<len; x++) {
		if(opt[x].selected) break;
		}//alert(x);alert(len);
		if(x<len) {
		//alert('');
		//return false;
		if(x==0){
			
           alert('Please Select hotel type');	
		   return false;
		}
		} 
		else {
			
           alert('Please Select hotel type');	
		   return false;}
		   
		var opt = document.registration.elements["hotel_name[]"].options;
		var x, len = opt.length;
		for (x=0; x<len; x++) {
		if(opt[x].selected) break;
		}//alert(x);alert(len);
		if(x<len) {
		//alert('');
		//return false;
		if(x==0){
			
           alert('Please Select hotel Name');	
		   return false;
		}
		} 
		else {
			
           alert('Please Select hotel Name');	
		   return false;}
	if(Fname.price_pp.value=='')
	{
		 alert('Please Enter Price/Person');
		return false;
	}
 
 if(!isnumber(Fname.price.value))
	{
		 alert('Please Enter Package Price');
		 Fname.price.value='';
		Fname.price.focus();
		return false;
	}
 

 
  if(Fname.thumbImage.value=='')
	{
		 alert('Please Select the Holiday thumb image');
		Fname.thumbImage.focus();
		return false;
	}
		
	  if(Fname.largeImage.value=='')
	{
		 alert('Please Select the Holiday Large image');
		Fname.largeImage.focus();
		return false;
	}
 
 if(Fname.image2.value!="")
	{
	//txt=document.banner;
		var Fname = Fname.image2.value;
		ext1=ext.split(".");
		
		ext=ext1[ext1.length-1];
		dee=ext1[1];
		
		//	alert(dee)
		ext = ext.toLowerCase();
		//alert(ext)
		if( ext != 'jpg' &&  ext != 'jpeg' && ext != 'gif' && ext!='png') 
		{
			alert("You selected a ."+ext+" file; Please select a Image file instead!");
			
			return false; 
		}
		
	}
	
	/* if(Fname.image3.value!="")
	{
	//txt=document.banner;
		var Fname = Fname.image3.value;
		ext1=ext.split(".");
		
		ext=ext1[ext1.length-1];
		dee=ext1[1];
		
		//	alert(dee)
		ext = ext.toLowerCase();
		//alert(ext)
		if( ext != 'jpg' &&  ext != 'jpeg' && ext != 'gif' && ext!='png') 
		{
			alert("You selected a ."+ext+" file; Please select a Image file instead!");
			
			return false; 
		}
		
	} 
 
 if(Fname.image1.value=='')
	{
		 alert('Please Select the Holiday Gallery image');
		Fname.image1.focus();
		return false;
	}	*/
}


function edit_hotel_validation() {
	Fname=document.registration;
	
	
	
	
	
	//txt=document.feedback;
	
	 var  radio_but=document.getElementById('holiday_type').value;
	// alert(radio_but)
	 //return false;
		myOption = -1;
	for (i=Fname.holiday_type.length-1; i > -1; i--) 
	 {
			if (Fname.holiday_type[i].checked)
			{
			myOption = i; i = -1;
	       }
	}
	
	// return false;
	if (myOption == -1)
	{
		alert("Please Select Holiday Type. ");
		return false;
	}
	
	//alert(myOption)
		var opt = document.registration.elements["holiday_title[]"].options;
		var x, len = opt.length;
		for (x=0; x<len; ++x) {
		if(opt[x].selected) break;
		}
		if(x<len) {
		//alert('');
		//return false;
		} 
		else {
			
           alert('Please Select Holiday Package Category');	
		   return false;}
	
	
	/*if(Fname.holiday_title.value=='')
	{
		 alert('Please Select Holiday Package Category');
		Fname.holiday_title.focus();
		return false;
	}
	*/
		if(Fname.package_title.value=='')
	{
		 alert('Please Select Holiday Package title');
		Fname.package_title.focus();
		return false;
	}
	
	
	
		var opt = document.registration.elements["desti[]"].options;
		var x, len = opt.length;
		for (x=0; x<len; ++x) {
		if(opt[x].selected) break;
		}
		if(x<len) {
		//alert('');
		//return false;
		} 
		else {
			
           alert('Please Select Holiday Destination');	
		   return false;}
	
	
	
	if(Fname.tour_type.value=='')
	{
		 alert('Please Enter Duration');
		Fname.tour_type.focus();
		return false;
	}
	
	
/*	if(Fname.datepicker.value=='')
	{
	 alert('Please Enter the Start Date');
	Fname.datepicker.focus();
	return false;
	}
	if(Fname.datepicker1.value=='')
	{
		 alert('Please Enter End Date');
		Fname.datepicker1.focus();
		return false;
	}
	*/
	/*if(Fname.datepicker1.value!='' && Fname.datepicker.value!=''){
	 if (CompareDates(Fname.datepicker1.value,Fname.datepicker.value))
            {
                alert("End - Date cannot be greater than From-in Date"); 
                Fname.datepicker1.focus();        
                return false; 
            }
	}*/
	
	var value = tinyMCE.get('desc').getContent();
            if (value == "") {
                alert('Please Enter the Description');
				return false;
            }
			
		var value = tinyMCE.get('highlight').getContent();
            if (value == "") {
                alert('Please Enter Highlights');
				return false;
            }
			
				var value = tinyMCE.get('iternery').getContent();
            if (value == "") {
                alert('Please Enter Itinery');
				return false;
            }
			
				var value = tinyMCE.get('terms').getContent();
            if (value == "") {
                alert('Please Enter the Terms and Conditions');
				return false;
            }		

	
	if(Fname.price.value=='')
	{
		 alert('Please Enter 3 * Holiday hotel Price');
		Fname.price.focus();
		return false;
	}
 
 if(!isnumber(Fname.price.value))
	{
		 alert('Please Enter Valid 3 * Holiday hotel Price');
		 Fname.price.value='';
		Fname.price.focus();
		return false;
	}
 
 
 	
	if(Fname.price1.value=='')
	{
		 alert('Please Enter 4 * Holiday hotel Price');
		  
		Fname.price1.focus();
		return false;
	}
 
 if(!isnumber(Fname.price1.value))
	{
		 alert('Please Enter Valid 4 * Holiday hotel Price');
		 Fname.price1.value='';
		Fname.price1.focus();
		return false;
	}
 
 
 if(Fname.image4.value!="")
	{
	//txt=document.banner;
		var Fname = Fname.image4.value;
		ext1=ext.split(".");
		
		ext=ext1[ext1.length-1];
		dee=ext1[1];
		
		//	alert(dee)
		ext = ext.toLowerCase();
		//alert(ext)
		if( ext != 'jpg' &&  ext != 'jpeg' && ext != 'gif' && ext!='png') 
		{
			alert("You selected a ."+ext+" file; Please select a Image file instead!");
			
			return false; 
		}
		
	}
	
	

	
	 if(Fname.image3.value!="")
	{
	//txt=document.banner;
		var Fname = Fname.image3.value;
		ext1=ext.split(".");
		
		ext=ext1[ext1.length-1];
		dee=ext1[1];
		
		//	alert(dee)
		ext = ext.toLowerCase();
		//alert(ext)
		if( ext != 'jpg' &&  ext != 'jpeg' && ext != 'gif' && ext!='png') 
		{
			alert("You selected a ."+ext+" file; Please select a Image file instead!");
			
			return false; 
		}
		
	} 
 
 
 
 
 
 
 
 if(Fname.image1.value!="")
	{
	//txt=document.banner;
		var Fname = Fname.image1.value;
		ext1=ext.split(".");
		
		ext=ext1[ext1.length-1];
		dee=ext1[1];
		
		//	alert(dee)
		ext = ext.toLowerCase();
		//alert(ext)
		if( ext != 'jpg' &&  ext != 'jpeg' && ext != 'gif' && ext!='png') 
		{
			alert("You selected a ."+ext+" file; Please select a Image file instead!");
			
			return false; 
		}
		
	}
	



	
}


function CompareDates(str1,str2) 
        { 
            var dt1  = parseInt(str1.substring(0,2),10); 
            var mon1 = parseInt(str1.substring(3,5),10); 
            var yr1  = parseInt(str1.substring(6,10),10); 
            var dt2  = parseInt(str2.substring(0,2),10); 
            var mon2 = parseInt(str2.substring(3,5),10); 
            var yr2  = parseInt(str2.substring(6,10),10); 
            var date1 = new Date(yr1, mon1, dt1); 
            var date2 = new Date(yr2, mon2, dt2); 
        
            if(date2 < date1) 
            { 
                return false; 
            } 
            else 
            { 
                return true; 
            } 
        } 

function enterNumerics(e)
	{	
	if (!e) var e = window.event;
	if(!e.which) key = e.keyCode; 
	else key = e.which; 
	if((key>=48)&&(key<=57)||key==8||key==9||key==32||key==45 || key==43 || key==46)
	{
	key=key;
	return true;
	}
	else
	{
	
	return false;
	}
	}
	
	
	
function isnumber(str){
if(str.length==0)
{
	return false;
}
numdecs = 0;
for (i = 0; i < str.length; i++)
{
mychar = str.charAt(i);
if ((mychar >= "0" && mychar <= "9") || mychar == "." ){
if (mychar == ".")
numdecs++;
}
else return false;
}
if (numdecs > 1){return false;}
return true;
}


function move(fbox,tbox)
 {
//	 alert(fbox.value);	 alert(tbox.value);
	 var arrFbox = new Array();
	 var arrTbox = new Array();
	 var arrLookup = new Array();
	 var i;
	
	 if(fbox.value=="")
	 {
	 alert("Please Select atleast one city from the Destination List Panel");
	 return false;
	 }
	 for (i = 0; i < tbox.options.length; i++) 
	 {
	  arrLookup[tbox.options[i].value] = tbox.options[i].text;
	  arrTbox[i] = tbox.options[i].value;
	 }
	 var fLength = 0;
	 var tLength = arrTbox.length;
	 for(i = 0; i < fbox.options.length; i++) 
	 {
	  arrLookup[fbox.options[i].value] = fbox.options[i].text;
		  if (fbox.options[i].selected && fbox.options[i].value != "") 
		  {
		   arrTbox[tLength] = fbox.options[i].value;
		   tLength++;
		   }
		  else 
		  {
		   arrFbox[fLength] = fbox.options[i].value;
		   fLength++;
		  }
	  }
	//arrFbox.sort();
	 //arrTbox.sort();
	 fbox.length = 0;
	 tbox.length = 0;
	 var c;
	 for(c = 0; c < arrFbox.length; c++) {
	  var no = new Option();
	  no.text = arrLookup[arrFbox[c]];
	  no.value = arrFbox[c];
	  fbox[c] = no;
	  }
	 for(c = 0; c < arrTbox.length; c++) {
	  var no = new Option();
	  no.text = arrLookup[arrTbox[c]];
	  no.value = arrTbox[c];
	  tbox[c] = no;
	  }
/*	  
	  	 if(tbox==document.seller_acc.subcid)
	 {
	    ptr=document.seller_acc.subcid;
	 }

	 
	  len=ptr.length;
	 //alert(len);
	  var i=0;
	  for(i=0; i<len; i++)
	  {
	 ptr.options[i].selected=true;
 
 	  }*/
	}
	
	 function move1(fbox,tbox)
 {
//	  alert(fbox.value);	 alert(tbox.value);
	 var arrFbox = new Array();
	 var arrTbox = new Array();
	 var arrLookup = new Array();
	 var i;
	
	 if(fbox.value=="")
	 {
	 alert("Please Select atleast one City from the City list To Destination List Panel");
	 return false;
	 }
	 for (i = 0; i < tbox.options.length; i++) 
	 {
	  arrLookup[tbox.options[i].value] = tbox.options[i].text;
	  arrTbox[i] = tbox.options[i].value;
	 }
	 var fLength = 0;
	 var tLength = arrTbox.length;
	 for(i = 0; i < fbox.options.length; i++) 
	 {
	  arrLookup[fbox.options[i].value] = fbox.options[i].text;
		  if (fbox.options[i].selected && fbox.options[i].value != "") 
		  {
		   arrTbox[tLength] = fbox.options[i].value;
		   tLength++;
		   }
		  else 
		  {
		   arrFbox[fLength] = fbox.options[i].value;
		   fLength++;
		  }
	  }
	//arrFbox.sort();
	 //arrTbox.sort();
	 fbox.length = 0;
	 tbox.length = 0;
	 var c;
	 for(c = 0; c < arrFbox.length; c++) {
	  var no = new Option();
	  no.text = arrLookup[arrFbox[c]];
	  no.value = arrFbox[c];
	  fbox[c] = no;
	  }
	 for(c = 0; c < arrTbox.length; c++) {
	  var no = new Option();
	  no.text = arrLookup[arrTbox[c]];
	  no.value = arrTbox[c];
	  tbox[c] = no;
	  }
/*	  
	  	 if(tbox==document.seller_acc.subcid)
	 {
	    ptr=document.seller_acc.subcid;
	 }

	 
	  len=ptr.length;
	 //alert(len);
	  var i=0;
	  for(i=0; i<len; i++)
	  {
	 ptr.options[i].selected=true;
 
 	  }*/
	} 
	
	
	
function change_pass(){
		
	fname=document.change_password;
	if(fname.curpwd.value==''){
		alert('Please Enter Current Password')
		fname.curpwd.focus();
		return false;
	}
	if(fname.newpwd.value==''){
		alert('Please Enter New Password')
		fname.newpwd.focus();
		return false;
	}
	if(fname.con_firm.value==''){
		alert('Please Enter Confirm Password')
		fname.con_firm.focus();
		return false;
	}
	
	if(fname.newpwd.value!=fname.con_firm.value){
		alert(" Confirm Password Doesn't Match New Password")
		fname.con_firm.focus();
		fname.con_firm.value=''
		return false;
	}
	}

	
