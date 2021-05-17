<html>
    <head>
        <link rel="stylesheet" href="bootstrap3/css/bootstrap.min.css" >
        <script src="js/jQuery-2.1.4.min.js"></script>
        <script src="bootstrap3/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="js/svjlib/jquery.svg.css">

        <script src="js/svjlib/jquery.svg.js"></script>

        <script src="js/poste.js"></script>
<script>
    $(document).ready(function () {

        var Usine  = new UsineChaine({NbrPoste:11,TypeAffiche:10,Nbrchaine:6,emplacement:"chaines"});

        Usine.LoadPoste();
        Usine.Afficher();

        Usine.on("finished",function(){
            Usine.enablePoste(5,3);
        });

    });
</script>
    </head>
    <body>

        <div class="row">
            <div class="col-md-3">
                <br>
                <fieldset>
                    <legend>Statistique</legend>
                    <label for="nbrelmentcontrole">
                        Nbr. en contrôle <input type="text" name = "nbrelmentcontrole" id="nbrelmentcontrole">
                    </label>
                    <label for="nbrelmenttri">
                        Nbr. en tris: <input type="text" name = "nbrelmenttri" id="nbrelmenttri">
                    </label>
                    <label for="qtentraitement">
                        Qt. en traitement : <input type="text" name = "qtentraitement" id="qtentraitement"><br>
                    </label>
                </fieldset>

            </div>
            <div id="chaines" class="col-md-7">
            </div>
        </div>
    </body>
</html>