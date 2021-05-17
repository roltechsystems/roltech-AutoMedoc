$(function(){ 

	 

	  // Initialize tablesorter
	  // ***********************


		$("#favorable").change( function(){
	 				alert($(this).val());
					switch ($(this).val()) {
					case 0:
						$("#fractionnement").attr("disabled", "disabled");
						break;
					case -1:
						
						break;
					case 1:
						
						break;

					default:
						break;
					}
			}
		);

	 function verifaddpay(){
		 
		  
			$.ajax({
				type:"POST",
				url: "<?=$this->url( array('module'=>'admin','controller'=>'payements','action'=>'masquerpayement'),null,false)?> ", 
				data:{
					 preinscript:$("#preinscription").val() 
					 
		    		},
				beforeSend :function(){},
				success:function(response){  
					 
					  if(response=='faux'){
					 	$("#formpay :input").removeAttr("disabled");
					} else if(response=='oui'){  
						$("#formpay :input").attr("disabled", "disabled");
					} 
				}
			});
		}

	 
		
	 function loadpayements(zone,url){
			
		  
			$.ajax({
				type:"POST",
				url: url, 
				data:{
					 preinscript:$("#preinscription").val()
					 ,niveau:$("#niveau").val()
					 
		    		},
				beforeSend :function(){ 
				     $('#'+zone).html("<option value=''>Encours...</option>");
				    },
				success:function(response){ 
			    	$('#'+zone).html(response); 
				}
			});
		}
	
	  function updateaction(idpreinscript, action,etat,zone){
			
		  
			$.ajax({
				type:"POST",
				url:"<?=$this->url( array('module'=>'admin','controller'=>'inscrits','action'=>'updateetat'),null,false)?> " , 
				data:{
					 preinscript:idpreinscript
					 ,action:action
					 ,etat:etat
					 ,stat:$('#'+etat+"_"+idpreinscript).is(':checked')
		    		},
				beforeSend :function(){ 
				     $('#'+zone).html("<option value=''>Encours...</option>");
				    },
				success:function(response){ 
			    	$('#'+zone).html(response); 
				}
			});
		}
			     



		var optmyform = { 
			    beforeSend: function()  { },
			    uploadProgress: function(event, position, total, percentComplete) { },
			    success: function() { },
				complete: function(response) 
				{
					var obj = JSON.parse(response.responseText);
					if(obj.status=="success"){
						$("#messageconfig").html("<font color='green'>"+obj.status+"</font>");
						if(obj.insertpay=='1'){ 
							loadpayements("facture","<?=$this->url( array('module'=>'admin','controller'=>'payements','action'=>'selectoptionactpay'),null,false)?> ");
						 	verifaddpay(); 
						}else{
							$("#formpay :input").attr("disabled", "disabled");
						}
					}else{
						 
							$("#messageconfig").html("<font color='red'>"+obj.message+"</font>");
					 
						 
					}
					
				},
				error: function()
				{	
					$("#messageconfig").html("<font color='red'> ERROR: unable to upload files</font>");
					
				}
			     
			}; 
 			$("#myForm").ajaxForm(optmyform); 
	 		 
 			var optformpay = {
 					  
 				    beforeSend: function()  {
							
 	 				     },
 				    uploadProgress: function(event, position, total, percentComplete) { },
 				    success: function() { },
 					complete: function(response) 
 					{
 						var obj = JSON.parse(response.responseText);
 						$("#messagepay").html("<font color='green'>"+obj.status+"</font>");
						 loadpayements("listpay","<?=$this->url( array('module'=>'admin','controller'=>'payements','action'=>'listedesoppay'),null,false)?> ");
	 					 loadpayements("facture","<?=$this->url( array('module'=>'admin','controller'=>'payements','action'=>'selectoptionactpay'),null,false)?> ");
		 					verifaddpay(); 
 					},
 					error: function()
 					{	
 						$("#messagepay").html("<font color='red'> ERROR: unable to upload files</font>");
						  
 					} 
 				     
 				}; 
			 $("#formpay").ajaxForm(optformpay);  
			 loadpayements("listpay","<?=$this->url( array('module'=>'admin','controller'=>'payements','action'=>'listedesoppay'),null,false)?> ");
			 loadpayements("facture","<?=$this->url( array('module'=>'admin','controller'=>'payements','action'=>'selectoptionactpay'),null,false)?> ");
			  verifaddpay(); 

			 
	  
	});
 