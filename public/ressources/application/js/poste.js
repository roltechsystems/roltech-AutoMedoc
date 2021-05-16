/**
 * Created by username on 12/07/2016.
 */

var UsineChaine = function(options){
    var root = this;

    this.NbrPoste ;
    this.TypeAffiche ;
    this.Nbrchaine ;
    this.emplacement;
    this.svgPoste ;

    this.construct = function(options){
        $.extend(this , options);
    };
    this.enablePoste=function(chaine,poste){
        var svg=$('#Poste_'+chaine+"_"+poste).svg('get');
        $('rect', svg.root()).each(
            function(){
                $(this).css('fill','green');
            }
        );

        $('path', svg.root()).each(
            function(){
                $(this).css('fill','green');
            }
        )

    }
    this.Afficher= function() {

    };
    this.LoadPoste = function(){

        /* Callback after loading external document */
        for(var c=0;c< this.Nbrchaine;c++) {
            $('#'+this.emplacement).append("<div id='Chaine_"+c +"' class='row'></div>");
            for(var i=0;i< this.NbrPoste;i++) {
                $("#Chaine_"+c).append("<div id='Poste_"+c+"_"+i+"' class='col-md-1'></div>");
                $("#Poste_"+c+"_"+i).svg({
                    onLoad: function () {
                        var svg = $("#Poste_"+c+"_"+i).svg('get');
                        var id= c+"_"+i;
                        svg.load('images/svg/poste.svg', {addTo: true,  changeSize: true,
                            onLoad: function (svg1) {
                                svg1.configure({id:'imgP_'+id,width: '100px', height: '100px'});
                               var nbr=0;
                                $('rect', svg1.root()).each(
                                    function(){
                                        nbr++;
                                       var idt= $(this).attr('id');
                                        idt=idt.replace("?",id+"_"+nbr);
                                        $(this).attr('id',idt);

                                        console.log(idt);
                                    }
                                );
                                nbr=0;
                                $('path', svg1.root()).each(
                                    function(){
                                        nbr++;
                                        var idt= $(this).attr('id');
                                        idt=idt.replace("?",id+"_"+nbr);
                                        $(this).attr('id',idt);
                                        console.log(idt);

                                    }
                                )
                                if(root.NbrPoste==i && root.Nbrchaine==c){
                                    $.event.trigger( "fineshed" );
                                }


                            }

                        });
                     },
                });
            }
        }

    }

    this.construct(options);
}
