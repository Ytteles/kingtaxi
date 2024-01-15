<?php 
    require_once __DIR__.'/boot.php';

?>
<?php 

    $dateCond = "`order_data` BETWEEN '1001-02-21' AND '2023-10-10' ";
    if (!empty($_GET['from']) && !empty($_GET['to'])) {
        $dateCond = "`order_data` BETWEEN '{$_GET['from']}' AND '{$_GET['to']}' ";
    }
    
    $classTaxi = "(`class_taxi`='1' or `class_taxi`='2' or `class_taxi`='3' or `class_taxi`='4' or `class_taxi`='5' or `class_taxi`='6')";
    if (!empty($_GET['class_taxi'])) {
        $classTaxi = "`class_taxi` = '{$_GET['class_taxi']}'";
    }

    $IDvozr = 'DESC';
    if (!empty($_GET['IDorder'])) {
        if ( strcmp($_GET['IDorder'], 'По возрастанию') == 0) {
            $IDvozr = 'ASC';
        }
        else if (strcmp($_GET['IDorder'], 'По убыванию') == 0){
            $IDvozr = 'DESC';
        }
        else {
            $IDvozr = 'DESC';
        }
    }
    $order = "`order_id`,`order_data`, `locationIn`, `locationOut`, `user_number`, `comment` ORDER BY `order_id`";
    $sql = "SELECT `order_data`, `order_id`, `locationIn`, `locationOut`, `user_number`, `comment`, `class_taxi` FROM `order` WHERE {$dateCond} AND {$classTaxi}   GROUP BY  {$order} {$IDvozr};";


    $stmt = pdo()->prepare($sql);
    $stmt->execute();
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
?> 

<html lang="Russia">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KINGS TAXI</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" type="image/icon" href="/img/Логовкладка.png">
</head>
<body class="feedback__body">
    <!-- Навигация по сайту -->
    <header class="head__fed">
        <nav class="header__nav">
            <ul class="menu header__menu__fed">
            <li class="menu__item menu__logo">
                <a href="/index.php" class="menu__link logo__item">
                <div class="Logo">
                    <img src="/img/лого.png" alt="Логотип">
                </div>
                </a>
                
            </li>
            
            <li class="menu__item"><a href="adminka.php" class="menu__link">История заказов</a></li>
            <li class="menu__item"><a href="application.php" class="menu__link">Заявки</a></li>
            <li class="menu__item"><a href="support.php" class="menu__link">Поддержка</a></li>
            
            <form class="form__center" method="post" action="do_logout.php">
                <button class="menu__item button__item" type="submit">
                    <div class="input__text__center">
                        Выход
                    </div>
                </button>
            </form>
            
            </ul>
        </nav>
    </header>

    <div>
        <H2 class="h2__style"> Заявки</H2>
        <form action="adminka.php" methode="GET">
            <div class="form__group">
                <label>От:</label>
                <input type="date" class="datepicker btn-block"  name="from" id="fromDate" Placeholder="Select From Date" value="<?php echo isset($_GET['from']) ? $_GET['from'] : '' ?>">
            </div>
            <div class="form__group">
                <label>До:  </label>
                <input type="date" name="to" id="toDate" class="datepicker btn-block"  Placeholder="Select To Date" value="<?php echo isset($_GET['to']) ? $_GET['to'] : '' ?>">
            </div>

            <div class="form__group"> 
                <label for="class_taxi">ID заказа вывод: </label>
                <select class="custom-select" name="IDorder" id="IDorder">
                    <option value="Выберите значение">Выберите значение</option>
                    <option value="По убыванию">По убыванию</option>
                    <option value="По возрастанию">По возрастанию</option>    
                </select>
            </div> 
            
            <div class="form__group">
                <label for="class_taxi">Тип такси: </label>
                <select class="custom-select" name="class_taxi" id="class_taxi">
                    <option value="">Тип такси</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-paper-plane"></i> Submit</button>
        </form>
    </div>

    <form  action="xml.php" methode="post"> 
        <input type="submit" name="my_button" value="Нажать для скачивания xml"> 
    </form>
    
    
    <table id="table" class="display" cellspacing="0" style="width:100%">
        <thead style="font: bold; active" align="center">
            <tr>
            <td align= center>ID заказа</td>
            <td align= center>ID клиента</td>
            <td align= center>Откуда</td>
            <td align= center>Куда</td>
            <td align= center>Класс такси</td>
            <td align= center>Комментарий</td>
            <td align= center>Дата заказа</td>
            </tr>
        </thead>
        <tbody>
    
            <?php
            foreach ($arr as $index) {
                echo '<tr>';
                    echo '<td align= center>' . $index['order_id'] . '</td>';
                    echo '<td align= center>' . $index['user_number'] . '</td>';
                    echo '<td align= center>' . $index['locationIn'] . '</td>';
                    echo '<td align= center>' . $index['locationOut'] . '</td>';
                    echo '<td align= center>' . $index['class_taxi'] . '</td>';
                    echo '<td align= center>' . $index['comment'] . '</td>';
                    echo '<td align= center>' . $index['order_data'] . '</td>';
                echo '</tr>';
            }
            $_SESSION['arr'] = $arr;
            
            ?>

            <script> 
            </script>

        </tbody>
    </table>

    
    


    

</body>
</html>