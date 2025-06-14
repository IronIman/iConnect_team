<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Participation Certificate</title>
        <link rel="icon" type="image/x-icon" src="\images\logo_idrivers.png">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
        <style>
            body{
                background-image:url('images\\participation_template.png');
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
            }
            @page {
                margin: 0;
                padding: 0;
            }
        </style>
    </head>
    <body>
        <div style="position: relative; width: 1123px; height: 794px;">
            <div style="position: absolute; top: 320px; left: 0; width: 70%; text-align: center;">
                <h2 style="margin: 0;">{{ strtoupper($projects->leader) }}</h2><
                <h2 style="margin: 0;">{{ strtoupper($projects->member1) }}</h2>
                <h2 style="margin: 0;">{{ strtoupper($projects->member2) }}</h2>
                <h2 style="margin: 0;">{{ strtoupper($projects->member3) }}</h2>
                <h2 style="margin: 0;">{{ strtoupper($projects->member4) }}</h2>
            </div>

            <div style="position: absolute; top: 600px; left: 0; width: 70%; text-align: center;">
                <h3>{{ strtoupper($projects->title) }}</h3>
            </div>

            <div style="position: absolute; top: 920px; left: 0; width: 70%; text-align: center;">
                <h2>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</h2>
            </div>
        </div>
    </body>
</html>