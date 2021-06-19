<?php

$yaml_data = $_GET['data'];

echo $yaml_data;
?>
   <div class="logo"">
    <img height="40px" src="http://localhost/img/json_icon.png" alt="yaml_logo">
    <img height="40px" src="http://localhost/img/yaml_icon.png" alt="json_logo">
    </div>
    <nav>
        <ul>
            <li><a href="">Начало</a></li>
            <li><a href="#converter">Convertor</a></li>
            <li><a href="#about-us">За нас</a></li>
        </ul>
    </nav>
    <div class="profile">
        <?php  if (isset($_SESSION['username'])) : ?>
        Здравей,
            <strong><?php echo $_SESSION['username']; ?></strong>
        <?php endif ?>
        </i>
        <a href="index.php?logout='1'">Logout</a>
    </div>

<?php

session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Начало</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="JS/script.js"></script>
</head>
<body>

<header>
    <div class="grid-container">
        <div class="logo">
            <img height="40px" src="http://localhost/img/json_icon.png" alt="yaml_logo">
            <img height="40px" src="http://localhost/img/yaml_icon.png" alt="json_logo">
        </div>
        <div class="nav_menu">
            <ul>
                <li><a href="">Начало</a></li>
                <li><a href="#converter">Convertor</a></li>
                <li><a href="#about-us">За нас</a></li>
            </ul>
        </div>
        <div class="profile">
            <?php  if (isset($_SESSION['username'])) : ?>
                Здравей,
                <strong><?php echo $_SESSION['username']; ?></strong>
            <?php endif ?>
            </i>
            <a href="index.php?logout='1'">Logout</a>
        </div>
    </div>
</header>

<!-- notification message -->
<?php if (isset($_SESSION['success'])) : ?>
    <div class="error success" >
        <h3>
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </h3>
    </div>
<?php endif ?>

<main>
    <div id="converter" class="sides-wrapper">
        <form method="get" onsubmit="test()">
            <div class="side-input">
                <form method="post" action="" name="form">
                    <label>YAML/JSON input</label>
                    <div class="side-box">
                        <div class="data-wrapper">
                    <textarea data-autosave id="data" name="data">
                        <?php
                        echo htmlspecialchars($_GET['data']);
                        ?>
                    </textarea>
                        </div>
                        <div>
                            <input type="file"/>
                            <input type="reset"/>
                        </div>
                    </div>
                    <input type="submit" id="convert-button" name="convert" value="Convert"/>
                </form>
            </div>

            <div class="side-input">
                <label>JSON output</label>
                <div class="side-box">
                    <div class="data-wrapper">
                    <textarea data-autosave>
                        <?php
                        $yaml = $_GET['data'];

                        $data = yaml_parse($yaml);

                        $output = [];
                        foreach ($data as $key => $entry) {
                            assignArrayByPath($output, $key, $entry);
                        }

                        function assignArrayByPath(&$arr, $path, $value, $separator = '.')
                        {
                            $keys = explode($separator, $path);

                            foreach ($keys as $key) {
                                $arr = &$arr[$key];
                            }

                            $arr = $value;
                        }

                        echo json_encode($output, JSON_PRETTY_PRINT);
                        ?>
                    </textarea>
                    </div>
                </div>
            </div>

            <div class="side-input">
                <label>YAML output</label>
                <div class="side-box">
                    <div class="data-wrapper">
                    <textarea data-autosave>
                        <?php
                        echo is_string($_GET['data']);
                        $yaml = $_GET['data'];




                        ?>
                    </textarea>
                    </div>
                </div>
            </div>
    </div>


    <div class="info">
        <h2>Условие</h2>
        <p>
            Да се направи сайт, който след регистрация да може да се пейства (или ъплоудва) изходен файл, да речем yaml и да го преобразува към json и обратно. Резултатният файл да седи в история - ако го запише или по настройка потребителя е записал всяко преобразуване да се записва, като може да добави и коментар към преобразуването и опции (да речем да се подравнява, да се прави в upper-case/cammel-case/shake_case , да се заместват имена на тагове и стойности - ако са конфигурирани (например json:ver ==> yaml:version;) version : 1.0 -> version: latest (1.0->latest))...
        </p>
    </div>

    <div id="about-us" class="info">
        <h2>За нас</h2>
        <p>Проект по WEB, СИ 3-ти курс</p><br>
        <ul>
            <li>Александър Николов ФН: 62298</li>
            <li>Весела Попова</li>
            <li>Елиа Младенова</li>
        </ul>
    </div>



</main>
</body>
</html>