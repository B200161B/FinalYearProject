<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="jqueryrouter/dist/js/jquery.router.min.js"></script>
    <script src=""></script>
</head>
<body>
    <nav>
        <button data-page="/" >tab 1</button>
        <button data-page="/tab2">tab 2</button>
        <button data-page="/tab3">tab 3</button>
    </nav>

    <section data-page="/" class="firstPage">Tab 1</section>
<section data-page="/tab2" class="secondPage">Tab 2</section>
<section data-page="/tab3" class="thirdPage">Tab 3</section>
</body>
</html>