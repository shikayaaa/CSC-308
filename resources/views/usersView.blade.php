<div>
   <form action="{{ route('user.create') }}" method="POST">
    @csrf 
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Submit</button>
   </form>

   <table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><a href="{{ route('user.show', $user->id) }}">View</a></td>
        </tr>
        @endforeach
    </tbody>
</div>
