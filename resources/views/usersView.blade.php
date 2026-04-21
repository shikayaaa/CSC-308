<style>
    body { font-family: 'Inter', sans-serif; background: #f4f7f6; padding: 40px; color: #333; }
    .container { max-width: 1000px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
    
    h1 { color: #2d3748; margin-bottom: 20px; font-size: 24px; border-left: 4px solid #4a90e2; padding-left: 15px; }

    /* Form Design */
    .create-form { display: flex; gap: 10px; margin-bottom: 30px; padding: 20px; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; }
    input { padding: 10px; border: 1px solid #cbd5e0; border-radius: 6px; flex: 1; outline: none; }
    
    /* Table Design */
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th { text-align: left; background: #f1f5f9; padding: 12px; color: #64748b; font-size: 12px; text-transform: uppercase; }
    td { padding: 15px 12px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }

    /* Buttons */
    .btn { padding: 8px 14px; border-radius: 6px; border: none; cursor: pointer; font-weight: 600; text-decoration: none; transition: 0.2s; font-size: 13px; }
    .btn-primary { background: #4a90e2; color: white; }
    
    /* Action Buttons */
    .action-cell { display: flex; gap: 8px; }
    .btn-view { background: #ebf4ff; color: #4a90e2; border: 1px solid #c3dafe; }
    .btn-delete { background: #fff5f5; color: #e53e3e; border: 1px solid #fed7d7; }
    .btn-delete:hover { background: #e53e3e; color: white; }
</style>

<div class="container">
    <h1>User Management</h1>

    <form class="create-form" action="{{ route('user.create') }}" method="POST">
        @csrf 
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User Details</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>#{{ $user->id }}</td>
                <td><strong>{{ $user->name }}</strong></td>
                <td>{{ $user->email }}</td>
                <td class="action-cell">
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user? This cannot be undone.');">
                    <a href="{{ route('user.show', $user->id) }}" class="btn btn-view">View</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>