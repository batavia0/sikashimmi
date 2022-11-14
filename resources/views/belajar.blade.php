<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Belajar PHP</title>
</head>
<body>
    @foreach ($users as $user)
        @if ($user->id_jabatan == '1')
            <p>Hello Admin</p>
        @endif
    @endforeach
</body>
</html>