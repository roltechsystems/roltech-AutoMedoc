

function calculeproduction(){
    var idarticle=$('#idarticle').val();
    var idembalage=$('#idembalage').val();
    var idcarton = $('#idcarton').val();
    var dateexpo=$('#dateexp').val();

    var message="";

    if(!idarticle || idarticle==""){
        message+="<li>Article</li>";
    }
    if(!idembalage || idembalage==""){
        message+="<li>Embalage</li>";
    }

    if(dateexpo==""){
        message+="<li>Date d'expédition</li>";
    }
    if(message!=""){
        $("#msgformofg").html("<div class='alert alert-block alert-error fade in'>"
            +"<button type='button' class='close' data-dismiss='alert'>X</button>"
            +"<h4 class='alert-heading'>Il faut saisir l'ensemble des information suivante</h4>"
            +"<p> <ul>"+message+"</ul>"
            +" </p> </div>");
        return;
    }



}
/**
 *
 */
function poids(){
    var poidnetee=$('#poidnetee').val();
    var qts=$('#PAP').val();
    var unite=$('#unite').val();
    var nbrcarton;
    var nbree;
    var qtsparheur= $("#qtPP").val();
    if(poidnetee){

        nbree=qts/poidnetee;
        $('#nbree').val(nbree);

        var nbrcartonee = $('#CartonEE').val();
        if(nbrcartonee && nbree>0){
            $("#nbrcarton").val(nbree/nbrcartonee);
            $('#nbrheurtotale').val( qts / qtsparheur);
        }
    }
}

function poidsTab(index){
    var poidnetee=$('#poidnet_'+index).html();
    var qts=$('#qts_'+index).val();
     var unite=$('#unite_'+index).html();
    var nbrcarton;
    var nbree;
    var qtsparheur= $("#prodposte_"+index).html();

    var nbrposte =  $("#poste_"+index).val();

    if(poidnetee!=""){

        nbree=qts/poidnetee;
        $('#ee_'+index).val(nbree);

        var nbrcartonee = $('#CartonEE_'+index).val();
        if(nbrcartonee && nbree>0){
            $("#carton_"+index).val(nbree/nbrcartonee);
            $('#nbrheurtotale_'+index).val( qts / qtsparheur);
            var number = ( qts / qtsparheur)/nbrposte;
            var strnumber= number.toString().replace(".",",");
            var heur = strnumber.split(',');
            var dataheur;
            if(!heur[1]){
                dataheur= heur[0]+":00";
            }else{
                var tmp = "0."+heur[1];
                var dicimal =tmp*60;
                dataheur= heur[0]+":"+dicimal.toFixed(0);
            }

            $('#nbrheurposte_'+index).val(dataheur);

            $('#posteheurtxt_'+index).html(dataheur);
            $('#qtsextract_'+index).html($('#qts_'+index).val());
            $('#nbcarton_'+index).html($("#carton_"+index).val());
            $('#nbrheurtotaletxt_'+index).html( $('#nbrheurtotale_'+index).val());
            $('#nbree_'+index).html($('#ee_'+index).val());

        }
    }
}
/***
 *
 */

function carton(){
    var poidnetee=$('#poidnetee').val();
    var qtsparheur= $("#qtPP").val();

    var unite=$('#unite').val();
    var nbrcartonee = $('#CartonEE').val();
    var nbrcarton= $("#nbrcarton").val();

    if(poidnetee){
        $('#PAP').val(poidnetee * nbrcartonee * nbrcarton);
        $('#nbree').val(nbrcartonee*nbrcarton);
        $('#nbrheurtotale').val( (poidnetee * nbrcartonee * nbrcarton) / qtsparheur);
    }
}

function cartontab(index){
    var poidnetee=$('#poidnet_'+index).html();
    var qtsparheur= $("#prodposte_"+index).html();

    var unite=$('#unite_'+index).html();
    var nbrcartonee = $('#CartonEE_'+index).val();

    var nbrposte =  $("#poste_"+index).val();

    var nbrcarton=  $("#carton_"+index).val();

    if(poidnetee!=""){
        $('#qts_'+index).val(poidnetee * nbrcartonee * nbrcarton);




        $('#ee_'+index).val(nbrcartonee*nbrcarton);
        $('#nbrheurtotale_'+index).val( (poidnetee * nbrcartonee * nbrcarton) / qtsparheur);
       var  qts = poidnetee * nbrcartonee * nbrcarton;
        var number = ( qts / qtsparheur)/nbrposte;
        var strnumber= number.toString().replace(".",",");
        var heur = strnumber.split(',');
        var dataheur;
        if(!heur[1]){
            dataheur= heur[0]+":00";
        }else{
            var tmp = "0."+heur[1];
            var dicimal =tmp*60;
            dataheur= heur[0]+":"+dicimal.toFixed(0);
        }

        $('#nbrheurposte_'+index).val(dataheur);

        $('#posteheurtxt_'+index).html(dataheur);
        $('#qtsextract_'+index).html(poidnetee * nbrcartonee * nbrcarton);
        $('#nbcarton_'+index).html(nbrcarton);
        $('#nbrheurtotaletxt_'+index).html( (poidnetee * nbrcartonee * nbrcarton) / qtsparheur);
        $('#nbree_'+index).html(nbrcartonee*nbrcarton);

    }
}
/***
 *
 */
function eeproduit(){
    var poidnetee=$('#poidnetee').val();
    var nbree=$('#nbree').val();
    var unite=$('#unite').val();
    var nbrcartonee = $('#CartonEE').val();
    var nbrcarton= $("#nbrcarton").val();
    var qtsparheur= $("#qtPP").val();
    if(poidnetee){
        $('#PAP').val(poidnetee * nbree );
        $('#nbrcarton').val( nbree/nbrcartonee);
        $('#nbrheurtotale').val( (poidnetee * nbree)/qtsparheur);
    }
}

function eeproduitabt(index){

    var poidnetee=$('#poidnet_'+index).html();
    var qtsparheur= $("#prodposte_"+index).html();

    var unite=$('#unite_'+index).html();
    var nbrposte =  $("#poste_"+index).val();


     var nbree= $('#ee_'+index).val();
     var nbrcartonee = $('#CartonEE_'+index).val();
    var nbrcarton=$("#carton_"+index).val();
     if(poidnetee){
         $('#qts_'+index).val(poidnetee * nbree );
         $("#carton_"+index).val( nbree/nbrcartonee);
         $('#nbrheurtotale_'+index).val( (poidnetee * nbree)/qtsparheur);
         var  qts = poidnetee * nbree;

         var number = ( qts / qtsparheur)/nbrposte;
         var strnumber= number.toString().replace(".",",");
         var heur = strnumber.split(',');
         var dataheur;
         if(!heur[1]){
             dataheur= heur[0]+":00";
         }else{
             var tmp = "0."+heur[1];
             var dicimal =tmp*60;
             dataheur= heur[0]+":"+dicimal.toFixed(0);
         }

         $('#nbrheurposte_'+index).val(dataheur);


         $('#posteheurtxt_'+index).html(dataheur);
         $('#qtsextract_'+index).html($('#qts_'+index).val());
         $('#nbcarton_'+index).html($("#carton_"+index).val());
         $('#nbrheurtotaletxt_'+index).html( $('#nbrheurtotale_'+index).val());
         $('#nbree_'+index).html($('#ee_'+index).val());

     }
}

/**
 *
 *
 */

function nbheurtravil(){
    var poidnetee=$('#poidnetee').val();
    var nbree=$('#nbree').val();
    var unite=$('#unite').val();
    var nbrcartonee = $('#CartonEE').val();

    var qtsparheur= $("#qtPP").val();
   var nbrhtravtt =$('#nbrheurtotale').val();
    if(qtsparheur){
        $('#PAP').val(nbrhtravtt * qtsparheur );
        $('#nbrcarton').val( (nbrhtravtt * qtsparheur)/(poidnetee*nbrcartonee));
        $('#nbree').val( (nbrhtravtt * qtsparheur)/ poidnetee );
    }
}

function nbheurtraviltab(index){

    var poidnetee=$('#poidnet_'+index).html();
    var qtsparheur= $("#prodposte_"+index).html();
    var unite=$('#unite_'+index).html();

    var nbree= $('#ee_'+index).val();
    var nbrcartonee = $('#CartonEE_'+index).val();
    var nbrcarton=$("#carton_"+index).val();
    var nbrposte =  $("#poste_"+index).val();


     var nbrhtravtt =$('#nbrheurtotale_'+index).val();
    if(qtsparheur!=""){
        $('#qts_'+index).val(nbrhtravtt * qtsparheur );
        $("#carton_"+index).val( (nbrhtravtt * qtsparheur)/(poidnetee*nbrcartonee));
        $('#ee_'+index).val( (nbrhtravtt * qtsparheur)/ poidnetee );
        var  qts =nbrhtravtt * qtsparheur;

        var number = ( qts / qtsparheur)/nbrposte;
        var strnumber= number.toString().replace(".",",");
        var heur = strnumber.split(',');
        var dataheur;
        if(!heur[1]){
            dataheur= heur[0]+":00";
        }else{
            var tmp = "0."+heur[1];
            var dicimal =tmp*60;
            dataheur= heur[0]+":"+dicimal.toFixed(0);
        }

        $('#nbrheurposte_'+index).val(dataheur);

        $('#posteheurtxt_'+index).html(dataheur);
        $('#qtsextract_'+index).html($('#qts_'+index).val());
        $('#nbcarton_'+index).html($("#carton_"+index).val());
        $('#nbrheurtotaletxt_'+index).html( $('#nbrheurtotale_'+index).val());
        $('#nbree_'+index).html($('#ee_'+index).val());

    }
}
/**
 *
 */

function NbrposteTab(index){
    var poidnetee=$('#poidnet_'+index).html();
    var qts=$('#qts_'+index).val();
    var unite=$('#unite_'+index).html();
    var nbrcarton;
    var nbree;
    var qtsparheur= $("#prodposte_"+index).html();
    var nbrposte =  $("#poste_"+index).val();

    if(poidnetee!=""){

        nbree=qts/poidnetee;
        $('#ee_'+index).val(nbree);

        var nbrcartonee = $('#CartonEE_'+index).val();
        if(nbrcartonee && nbree>0){
            $("#carton_"+index).val(nbree/nbrcartonee);
            $('#nbrheurtotale_'+index).val( qts / qtsparheur);
            var number = ( qts / qtsparheur)/nbrposte;
            var strnumber= number.toString().replace(".",",");
            var heur = strnumber.split(',');
            var dataheur;
            if(!heur[1]){
                dataheur= heur[0]+":00";
            }else{
                var tmp = "0."+heur[1];
                var dicimal =tmp*60;
                dataheur= heur[0]+":"+dicimal.toFixed(0);
            }

            $('#nbrheurposte_'+index).val(dataheur);

            $('#posteheurtxt_'+index).html(dataheur);
            $('#qtsextract_'+index).html($('#qts_'+index).val());
            $('#nbcarton_'+index).html($("#carton_"+index).val());
            $('#nbrheurtotaletxt_'+index).html( $('#nbrheurtotale_'+index).val());


            $('#nbree_'+index).html($('#ee_'+index).val());
        }
    }
}