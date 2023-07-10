<!DOCTYPE html>
<html>
<head>
    <style type="text/css" media="screen">
        #header{
            font-family: Avenir,Helvetica,sans-serif;
            box-sizing: border-box;
            color: #bbbfc3;
            font-size: 19px;
            font-weight: bold;
            text-decoration: none;
        }
        h1{
            font-family: Avenir,Helvetica,sans-serif;
            box-sizing: border-box;
            color: #2f3133;
            font-size: 19px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }
        p{
            font-family: Avenir,Helvetica,sans-serif;
            box-sizing: border-box;
            color: #74787e;
            font-size: 16px;
            line-height: 1.5em;
            margin-top: 0;
            text-align: left;
        }
        #copyright{
            font-family: Avenir,Helvetica,sans-serif;
            box-sizing: border-box;
            line-height: 1.5em;
            margin-top: 0;
            color: #aeaeae;
            font-size: 12px;
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th> 
                <p id="header">
               Manifestation de Besoins APIP Guinée
                </p>
                </th>
            </tr>
        </thead>
    </table>

    <table>
        <caption></caption>
        <thead>
            <tr>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td>
                    <h1>Bonjour,</h1>

                    <p>Vous avez une nouvelle manifestation de besoin</p>

                    <p>Expéditeur : {{Auth::user()->name}}</p>

                    <p>Objet : {{$data->titre}}</p>

                    <p> <a target="_blank" href="http://192.168.20.150/manifestation_de_besoin/public/"> Ouvrir l'application</a></p>

                    <p>Cordialement.</p>
                </td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th> 
                <p id="copyright">
                © {{ date ('Y') }} Manifestation de Besoins APIP. Tous les Droits Réservés.
                </p>
                </th>
            </tr>
        </thead>
    </table>
</body>
</html>








