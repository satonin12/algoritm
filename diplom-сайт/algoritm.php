<?php

  $client_price = (int)$_POST["client_price"];

  $host = 'localhost';
  $db = 'diplom';
  $userDB = 'root';

  /*
    где-то храним готовые цепочки
    заказ визитки = исполнители из копицентра, дизайнер, типография + возможно доставка
    => 3 звена и возможное 4-е
  */
  $service = 'Заказ визитки';
  // предположим, что доставка включена в цепочку
  $serviceCount = 4;
  $service_array = array('Копицентр', 'Дизайнер', 'Типография', 'Доставка');
  $service_array_ENG = array('kopicentr', 'dizainer', 'tipogr', 'dost');

  $conn = mysqli_connect($host, $userDB, "", $db);
  if(!$conn){
    echo("Ошибка соединения");
    exit();
  }

  for($i = 0; $i < $serviceCount; $i++){
    // print($service_array[$i]);
    $query[$i] = "select исполнители.id, ставка.Ставка
            from исполнители, услуги, ставка
            where исполнители.Услуга_id = услуги.id
            and услуги.название_услуги = '$service_array[$i]'
            and исполнители.Доступность = true
            and исполнители.Ставка_id = ставка.id
            ORDER BY ставка.Ставка";
  }

  // $query = "select исполнители.id, ставка.Ставка
  //           from исполнители, услуги, ставка
  //           where исполнители.Услуга_id = услуги.id
  //           and услуги.название_услуги = 'Копицентр'
  //           and исполнители.Доступность = true
  //           and исполнители.Ставка_id = ставка.id
  //           ORDER BY ставка.Ставка";

  // for($i = 0; $i < $serviceCount; $i++){
    if($res = mysqli_query($conn, $query[0])){
      $count = mysqli_num_rows($res);
      $i = 0;
      while($row = $res->fetch_array(MYSQLI_ASSOC)){
        $kopicentr[$i][0] = $row["id"];
        $kopicentr[$i][1] = $row["Ставка"];
        $i++;
      }
    }
  // }
  // for($i = 0; $i < $serviceCount; $i++){
    if($res = mysqli_query($conn, $query[1])){
      $count = mysqli_num_rows($res);
      $i = 0;
      while($row = $res->fetch_array(MYSQLI_ASSOC)){
        $dizainer[$i][0] = $row["id"];
        $dizainer[$i][1] = $row["Ставка"];
        $i++;
      }
    }
  // }
  // for($i = 0; $i < $serviceCount; $i++){
    if($res = mysqli_query($conn, $query[2])){
      $count = mysqli_num_rows($res);
      $i = 0;
      while($row = $res->fetch_array(MYSQLI_ASSOC)){
        $tipogr[$i][0] = $row["id"];
        $tipogr[$i][1] = $row["Ставка"];
        $i++;
      }
    }
  // }
  // for($i = 0; $i < $serviceCount; $i++){
    if($res = mysqli_query($conn, $query[3])){
      $count = mysqli_num_rows($res);
      $i = 0;
      while($row = $res->fetch_array(MYSQLI_ASSOC)){
        $dost[$i][0] = $row["id"];
        $dost[$i][1] = $row["Ставка"];
        $i++;
      }
    }
  // }

  // if($res = mysqli_query($conn, $query)){
  //   $count = mysqli_num_rows($res);
  //   $i = 0;
  //   while($row = $res->fetch_array(MYSQLI_ASSOC)){
  //     $kopicentr[$i][0] = $row["id"];
  //     $kopicentr[$i][1] = $row["Ставка"];
  //     $i++;
  //   }
  // }
  // print('<br>[===============]<br>');

  // $kopicentr[0] = 450;
  // $kopicentr[1] = 550;
  // $kopicentr[2] = 650;
  // $kopicentr[3] = 350;
  // $kopicentr[4] = 400;

  // $dizainer[0] = 800;
  // $dizainer[1] = 900;
  // $dizainer[2] = 1000;
  // $dizainer[3] = 760;
  // $dizainer[4] = 1250;

  // $tipogr[0] = 1500;
  // $tipogr[1] = 2500;
  // $tipogr[2] = 1000;
  // $tipogr[3] = 1700;
  // $tipogr[4] = 1800;

  // $dost[0] = 300;
  // $dost[1] = 100;
  // $dost[2] = 200;
  // $dost[3] = 250;
  // $dost[4] = 150;

  print('<h3>Копицентры :</h3>');
  for($i = 0; $i < count($kopicentr); $i++){
    $k = $i+1;
    print('Исполнитель '.$k.' ID ['.$kopicentr[$i][0].'] Ставка х час - '.$kopicentr[$i][1]);
    print('<br>');
  }
  print('<br>');
  print('<h3>Дизайнеры :</h3>');
  // sort($dizainer, SORT_NUMERIC);
  for($i = 0; $i < count($dizainer); $i++){
    $k = $i+1;
    print('Исполнитель '.$k.' ID ['.$dizainer[$i][0].'] Ставка х час - '.$dizainer[$i][1]);
    // print($dizainer[$i][1]);
    print('<br>');
  }
  print('<br>');
  print('<h3>Типографии :</h3>');
  // sort($tipogr, SORT_NUMERIC);
  for($i = 0; $i < count($tipogr); $i++){
    $k = $i+1;
    print('Исполнитель '.$k.' ID ['.$tipogr[$i][0].'] Ставка х час - '.$tipogr[$i][1]);
    // print($tipogr[$i][1]);
    print('<br>');
  }
  print('<br>');
  print('<h3>Доставка :</h3>');
  // sort($dost, SORT_NUMERIC);
  for($i = 0; $i < count($dost); $i++){
    $k = $i+1;
    print('Исполнитель '.$k.' ID ['.$dost[$i][0].'] Ставка х час - '.$dost[$i][1]);
    // print($dost[$i][1]);
    print('<br>');
  }
  print('<br>[===============]<br>');
  for($i = 0; $i < 3; $i++){
    $cep1[$i] = $kopicentr[$i][1] + $dizainer[$i][1] + $tipogr[$i][1] + $dost[$i][1];
  }

  for($i = 0; $i < count($cep1); $i++){
    $k = $i+1;
    if($cep1[$i] <= $client_price){
      print('<br>');
      echo('Цепочка '.$k.' = Копицентр ID ['.$kopicentr[$i][0].'] ('.$kopicentr[$i][1].' рублей) -> Дизайнер ID ['.$dizainer[$i][0].'] ('.$dizainer[$i][1].' рублей) -> Типография ID ['.$tipogr[$i][0].'] ('.$tipogr[$i][1].' рублей) -> Доставка ID ['.$dost[$i][0].'] ('.$dost[$i][1].' рублей) = '.$cep1[$i].' рублей');
      print('<br>');
    }
  }

?>
