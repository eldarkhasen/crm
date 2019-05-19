<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Детали записи</title>
</head>
<body>
    <h1>Детали записи</h1>
    <p>Ваша запись назначена на <b>{{date('d.m.Y', strtotime($appointment->start))
        . " " . date('H', strtotime($appointment->start))
        . ":" . date('m', strtotime($appointment->start))}}</b>
    </p>

    <p>Сотруднк: <b>{{$employee->surname . " " . $employee->name}}</b></p>

    <p>Услуги:</p>
    <ul>
        @foreach($appointment->services as $service)
            <li>
                {{$service['name'] . " " . $service['price']}} тг.
            </li>
        @endforeach
    </ul>
    <strong>Итог {{$appointment->price}} тг. <i>(Предварительная цена)</i></strong>
    <br>
    <p>С уважением,<br>Aisadent</p>
</body>
</html>
