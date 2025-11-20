<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
</head>
<body>
    <h1>All Users</h1>

    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Admin</th>
        </tr>

        @foreach($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <th>{{ $user->name }}</th>
            <th>{{ $user->email }}</th>
            <th>{{ $user->is_admin ? 'Yes' : 'No' }}</th>
        </tr>
        @endforeach
    </table>
</body>
</html>