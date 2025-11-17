<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechWave — Company Profile</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-black">

    <div id="mixed-app"
         data-initial='@json($initialState)'
    ></div>
    @vite('resources/js/app.js')
</body>
</html>
