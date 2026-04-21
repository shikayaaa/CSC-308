<style>
    body { font-family: 'Inter', sans-serif; background: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
    .profile-card { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); width: 100%; max-width: 450px; }
    
    h2 { margin-bottom: 20px; color: #2d3748; text-align: center; font-size: 1.5rem; }
    
    .form-group { margin-bottom: 15px; }
    label { display: block; margin-bottom: 5px; color: #64748b; font-size: 14px; font-weight: 600; }
    
    input { 
        width: 100%; 
        padding: 12px; 
        border: 1px solid #e2e8f0; 
        border-radius: 8px; 
        box-sizing: border-box; 
        font-size: 14px;
        transition: border-color 0.2s;
    }
    input:focus { outline: none; border-color: #4a90e2; box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1); }

    .actions { display: flex; flex-direction: column; gap: 10px; margin-top: 25px; }
    
    .btn { 
        padding: 12px; 
        border-radius: 8px; 
        border: none; 
        font-weight: 600; 
        cursor: pointer; 
        text-decoration: none; 
        text-align: center;
        transition: 0.3s;
        font-size: 14px;
    }
    
    .btn-update { background: #4a90e2; color: white; }
    .btn-update:hover { background: #357abd; }
    
    .btn-back { background: #edf2f7; color: #4a5568; }
    .btn-back:hover { background: #e2e8f0; }

    .btn-delete { background: #fff5f5; color: #e53e3e; border: 1px solid #fed7d7; width: 100%; }
    .btn-delete:hover { background: #e53e3e; color: white; }
</style>

<div class="profile-card">
    <h2>Edit User Profile</h2>
    
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="form-group">
            <label>Full Name</label>
            <input type="text" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label>New Password (leave blank to keep current)</label>
            <input type="password" name="password" placeholder="********">
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-update">Save Changes</button>
            <a href="/users" class="btn btn-back">Cancel & Go Back</a>
        </div>
    </form>

    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

    <form action="{{ route('user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Delete this user permanently?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-delete">Delete User</button>
    </form>
</div>