<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Revival Threads</title>
</head>
<body class="text-gray-500">


    <div> <!-- content wrapper -->
        <div>
            <nav>
                <div>
                    <h1>
                        <a href="welcome" class="font-bold text-xl uppercase p-4"> Revival Threads </a>
                    </h1>
                </div>
                <div>
                        <ul>
                            <li>
                                <span> <a href="#"> Home </a></span>
                            <li>
                                <span> <a href="#"> Products </a> </span>
                            </li>
                            <li>
                                <span> <a href="#"> Men's </a> </span>
                            </li>
                            <li>
                                <span> <a href="#"> Women's </a> </span>
                            </li>
                        </ul>
                </div>
            </nav>
        </div> <!-- nav bar end-->

        <main class="px-16 py-6">
            <div>
                <a href="/login"> Log In </a>
                <a href="/register"> Sign Up </a>
            </div>

            <header> <h2 class="font-bold mt-10 pb-5"> Armory </h2> </header>
            <div> <!-- clothes cards -->

                <div>
                    <img src="{{ asset('img/1000_F_1242303249_J4PlMejurnyNXVkSyCbgr6cFWeOMfRcs.jpg') }}" alt="Cargos">
                    <div>
                        <span> Cargos </span>
                    </div>
                </div>

            </div>

            <h2 class="font-bold mt-10 pb-5"> Timeless Gear </h2>
            <div>
                <!-- More clothes cards {fill in with armory code after styling} -->

                <div>
                    <div>
                        Load More
                    </div>
                </div>
            </div>

        </main>
    </div>

</body>
</html>
