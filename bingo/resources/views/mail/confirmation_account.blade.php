<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
</head>
    <body>
        <div  style="margin: 5%;border: 5px #f0f0f0 groove; border-radius:15px;">
            <div style=" width : 100%;">
                <div style="margin: auto;width: 100%;padding: 10px;display: flex; justify-content: center; align-items: center;">
                    <img style="width :500px;height: 350px;margin-left:10%;display: flex; justify-content: center; align-items: center;" src="{{asset(config('path.logo.green'))}}" alt="Logo {{config('app.name')}}">
                </div>
                <div style=" width : 100%;text-align:center!important;">
                    <h3>Bonjour, </h3>

                    <p>Merci de vous être inscrit sur Notre Plateforme. Nous sommes ravis de vous accueillir parmi nous !</p>
                    <p>Pour vérifier votre compte, veuillez cliquer sur le bouton ci-dessous :</p>

                    <a href="{{ route('account.confirm', $code)}}" target="_blank" style="background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;margin: 4px 2px;cursor: pointer;border-radius:10px;"> Vérifier mon compte</a>

                    <p>N'hésitez pas à nous contacter si vous avez des questions ou des besoins d'assistance.</p>
                    <p>Cordialement,<br>L'équipe de {{config('app.name')}}</p>
                    
                </div>
            </div>
        </div>
        
    </div>
</html>