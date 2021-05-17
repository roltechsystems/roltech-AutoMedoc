function hiddenzone(zone){
	$('#'.zone).toggle('slow');
 
}

$(function() {
    $('[data-toggle="modal"]').click(function(e) {
      e.preventDefault();
      var href = $(this).attr('href');
      var titre= $(this).attr('titre');
      if (href.indexOf('#') == 0) {
         $(href).modal('open');
      } else {
	      $.get(href, function(data) {
	          
	        $('<div class="modal" role="dialog">' +
	               '<div class="modal-header">'+
	      		 '<a class="close" data-dismiss="modal" >X</a>'+
	      		  	'<h3>'+titre+'</h3>'+
	      		'</div>' +
	      		'<div class="modal-body">'+
	                data + 
	                '</div>'+
	           '</div>').modal();
	      });
      }
    });
  });

$(document).ready(function() {
	
	 
	
	$('#bt').click(function(){
		hiddenzone('ajoutbac');
	});
	
 
	
	 $("#aujordhuit").click(function(){

			// If checked
			if ($("#aujordhuit").is(":checked"))
			{
				//show the hidden div
				$('#aujordhuit1').show('slow');
				$('#aujordhuit2').show('slow');
			}
			else
			{
				//otherwise, hide it
				$('#aujordhuit1').hide('slow');
				$('#aujordhuit2').hide('slow');
			}
		  });

});
//98551123


function adddiplome(){
  
	
		$.ajax({
		type:"POST",
		url:"adddiplome",
		
		success:function(response){
	    	if (response){
	    		$(response).fadeIn('slow').prependTo('#diplomelist');
	    	}
		}
	});
		
	
}


function AjaxUpdateInfo(page,id,valueinfo,laodplace){
	 
	
	$.ajax({
		type:"POST",
		url:page,
		data:{id:params,value:valueinfo},
		beforeSend :function(){ 
			 $('#'+laodplace).append("Encours...");
		    },
		success:function(response){
			 
	    	if (response){
	    		$('#'+laodplace).html(response);
	    	}
		}
	});
}

function AjaxUpdate(page,id,valueinfo,operation,laodplace){
 
	$.ajax({
		type:"POST",
		url:page,
		data:{
			id:id, 
			value:valueinfo ,
			opt:operation
		},
		beforeSend :function(){ 
			 $('#'+laodplace).append("Encours...");
		    },
		success:function(response){
			var resp = jQuery.parseJSON(response);
			 if(resp.success=='ok'){
	    	 	$('#'+laodplace).html("<div class='alert alert-success'>"+resp.text+"</div>");
	    	 }else{
	    		 $('#'+laodplace).html("<div class='alert alert-error'>"+resp.text+"</div>");
	    	 }
	    		
	    	 
		}
	});
}
function AjaxEditR(id,valuetext,laodplace){
	$('#'+laodplace).toggle('slow');
		$('#'+laodplace).html("<textarea id='"+id+"'>"+valuetext+"</textarea><span class='badge badge-info' title='Ok'><a href='#' onclick=\"$('#"+laodplace+"').toggle('slow');\"><i class=' icon-ok icon-white'></i></span>");
	 
		 
}

function AjaxLoading(page,params,laodplace){
	 
	
	$.ajax({
		type:"POST",
		url:page,
		data:{id:params},
		beforeSend :function(){ 
			 $('#'+laodplace).html("Encours...");
		    },
		success:function(response){
			 
	    	if (response){
	    		$('#'+laodplace).html(response);
	    	}
		}
	});
}

function AjaxLoadingRow(page,params,row,laodplace){
	 
	
	$.ajax({
		type:"POST",
		url:page,
		data:{id:params,row:row},
		beforeSend :function(){ 
			 $('#'+laodplace).html("Encours...");
		    },
		success:function(response){
			 
	    	if (response){
	    		$('#'+laodplace).html(response);
	    	}
		}
	});
}

function AjaxVerif(page,params,typedata,laodplace){
	 
	
	$.ajax({
		type:"POST",
		url:page,
		data:{id:params,typedata:typedata},
		beforeSend :function(){ 
			 $('#'+laodplace).append("Encours...");
		    },
		success:function(response){
			 
	    	if (response){
	    		$('#'+laodplace).html(response);
	    	}
		}
	});
}

function Ajax2ParamLoad(page,params,params2,laodplace){
	 
	
	$.ajax({
		type:"POST",
		url:page,
		data:{id:params,id2:params2},
		beforeSend :function(){ 
			 $('#'+laodplace).html("Encours...");
		    },
		success:function(response){
			 
	    	if (response){
	    		$('#'+laodplace).html(response);
	    	}
		}
	});
}
function ModalAjaxRequest(page,laodplace,header,titre,data,idses){
	$.ajax({ 
    type: "GET", 
    url: page, 
    data:{form:data,idsess:idses}, 
    beforeSend :function(){ 
    	 //alert( $('#'.forms).serialize());
    },
    
    success: function(response,event){ 
    	if (response){
    		$('#'+laodplace).html(response);
    		$('#'+header).html(titre);
    	}
    } 
	});
}

 function insertTextIntoPos(idtext,text,typecomp){
	    var caretPos = document.getElementById(idtext).selectionStart;
	    var textAreaTxt = $("#"+idtext).val();
	    var txtToAdd = text;
	    if(typecomp=="CKEDITOR"){
	    	  CKEDITOR.instances[idtext].insertText(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos));
	    }else {
	    	$("#"+idtext).val(textAreaTxt.substring(0, caretPos) + txtToAdd + textAreaTxt.substring(caretPos) );
	    }
	  
 }


