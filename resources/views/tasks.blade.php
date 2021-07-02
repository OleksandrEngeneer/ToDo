<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/css/css.css') }}" rel="stylesheet" type="text/css">
    <title>Tasks</title>
</head>
<body>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="box_form">
        <form id="tasks" method="POST" name="tasks" action="/">
            @csrf
            <input type="text" name="text">
            <select name="category">
                @foreach ($categories as $category)
            <option value="{{$category['id']}}">{{$category['name']}}</option>
                @endforeach
            </select>
            <input type="date" name="deadline">
            <input type="submit" value="Запланувати" name="tasks" class="btn1">
        </form>
    </div>
    <table border="1" width="800px" cellspacing="0px">
        <p>Завдання на сьогодні</p>
        <tr>
            <th></th>
            <th>Text</th>
            <th>status</th>
            <th>deadline</th>
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td><input type="checkbox" form="done" name="<?= $task['id'] ?>"></td>
                <td>{{ $task['body'] }}</td>
                <td>{{ $task['status'] }}</td>
                <td>{{ $task['deadline'] }}</td>
            <tr>
        @endforeach
    </table>
    <div class="box_form">
        <form id="done" name="done" method="POST" action="/done">
            @csrf
            <input type="submit" value="Виконано" name="done" class="btn2">
            <input type="submit" value="Відтермінувати" name="delay" class="btn3">
            <input type="submit" value="Видалити" name="delete" class="btn4">
        </form>
    </div>
    <hr>
    <table border="1" width="800px" cellspacing="0px">
        <p>Відтерміновані</p>
        <tr>
            <th></th>
            <th>Text</th>
            <th>status</th>
            <th>deadline</th>
        </tr>
        @foreach ($tasks_frozen as $task)
            <tr>
                <td><input type="checkbox" form="reopen" name="<?= $task['id'] ?>"></td>
                <td>{{$task['body'] }}</td>
                <td>{{$task['status'] }}</td>
                <td>{{$task['deadline'] }}</td>
            <tr>
                @endforeach
    </table>
    <div class="box_form">
        <form id="reopen" name="reopen" method="POST" action="/reopen">
            @csrf
            <input type="submit" value="Перемістити до поточних завдань" name="reopen" class="btn5">
        </form>
    </div>
    <hr>
    <table border="1" width="800px" cellspacing="0px">
        <p>Виконані</p>
        <tr>
            <th></th>
            <th>Text</th>
            <th>status</th>
            <th>deadline</th>
        </tr>
        @foreach ($tasks_done as $task)
            <tr>
                <td><input type="checkbox" form="reopen" name="<?= $task['id'] ?>"></td>
                <td>{{$task['body'] }}</td>
                <td>{{$task['status'] }}</td>
                <td>{{$task['deadline'] }}</td>
            <tr>
                @endforeach
    </table>
</body>

</html>