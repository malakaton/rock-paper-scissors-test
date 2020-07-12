<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            #response li {
                list-style-type: none;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 64px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                Rock paper scissors: The game
            </div>

            <input type="submit" value="Play!" class="btn-submit-play">
            <br><br>

            <a href="reports/index.html" target="_blank">Code Coverage</a>

            <div id="response">
                <h3>Statistics:</h3>
                <h4>Number of match won</h4>
                <ul>
                    <li>First player: <span class="num-won-first-player">0</span></li>
                    <li>Second player: <span class="num-won-second-player">0</span></li>
                </ul>
                <h4>Number of draws on match: <span class="num-draws">0</span></h4>
            </div>
        </div>
    </div>
    </body>
</html>

<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-submit-play").click(function(e){
        e.preventDefault();

        $.ajax({
            type:'GET',
            url: '/api/rock-paper-scissors/play',
            dataType: "json",
            data:{},
            success:function(response){
                console.log(response.data);
                $('.num-won-first-player').html(response.data['statistics']['number of match won']['first player']);
                $('.num-won-second-player').html(response.data['statistics']['number of match won']['second player']);
                $('.num-draws').html(response.data['statistics']['number of draws on match']);
                alert(JSON.stringify(response.data));
            },
            error: function(XMLHttpRequest) {
                console.log(XMLHttpRequest);
                alert(XMLHttpRequest.responseText);
            }
        });
    });

</script>
