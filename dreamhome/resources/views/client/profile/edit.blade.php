<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamHome - Edit Profile</title>
    <link href="https://fonts.bunny.net/css?family=comfortaa:300|montserrat:400,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/c_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/c_profile.css') }}">
</head>
<body>

    <div class="dashboard-wrapper">
        <aside class="sidebar"> 
            <div class="sidebar-brand">
                <h1>DreamHome</h1>
                <span>Client Portal</span>
            </div>
            
            <nav class="sidebar-menu">
                <a href="{{ route('client.dashboard') }}" class="menu-item active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="9"></rect><rect x="14" y="3" width="7" height="5"></rect><rect x="14" y="12" width="7" height="9"></rect><rect x="3" y="16" width="7" height="5"></rect></svg>
                    Dashboard
                </a>
                <a href="{{ route('client.properties.index') }}" class="menu-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    Properties
                </a>
                <a href="#" class="menu-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    My Leases
                </a>
                <a href="#" class="menu-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    Viewings Schedule
                </a>
            </nav>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('client.logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            <header class="content-header">
                <div class="user-greeting">
                    <h2>Account Settings</h2>
                    <p>Update your personal info, housing preferences, or change your security password.</p>
                </div>
                <div class="avatar-box">
                    <span>{{ substr(auth()->guard('client')->user()->first_name, 0, 1) }}{{ substr(auth()->guard('client')->user()->last_name, 0, 1) }}</span>
                </div>
            </header>

            <div class="profile-container">
                @if(session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="details-card">
                    <div class="card-title-bar">
                        <h3>Modify Profile Registration Details</h3>
                    </div>
                    
                    <form method="POST" action="{{ route('client.profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-grid-two-col">
                            {{-- First Name --}}
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', auth()->guard('client')->user()->first_name) }}" required>
                                @error('first_name') <span class="error-message">{{ $message }}</span> @enderror
                            </div>

                            {{-- Last Name --}}
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" name="last_name" value="{{ old('last_name', auth()->guard('client')->user()->last_name) }}" required>
                                @error('last_name') <span class="error-message">{{ $message }}</span> @enderror
                            </div>

                            {{-- Email Address --}}
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ old('email', auth()->guard('client')->user()->email) }}">
                                @error('email') <span class="error-message">{{ $message }}</span> @enderror
                            </div>

                            {{-- Telephone Number --}}
                            <div class="form-group">
                                <label for="telephone_no">Telephone Number</label>
                                <input type="text" id="telephone_no" name="telephone_no" value="{{ old('telephone_no', auth()->guard('client')->user()->telephone_no) }}" required>
                                @error('telephone_no') <span class="error-message">{{ $message }}</span> @enderror
                            </div>

                            {{-- Preferred Property Type --}}
                            <div class="form-group">
                                <label for="prefer_type">Preferred Property Type</label>
                                <select id="prefer_type" name="prefer_type">
                                    <option value="">-- Select Preference --</option>
                                    @foreach(['condo', 'flat', 'house', 'studio', 'apartment'] as $type)
                                        <option value="{{ $type }}" {{ old('prefer_type', auth()->guard('client')->user()->prefer_type) == $type ? 'selected' : '' }}>
                                            {{ ucfirst($type) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('prefer_type') <span class="error-message">{{ $message }}</span> @enderror
                            </div>

                            {{-- Maximum Budget Limit --}}
                            <div class="form-group">
                                <label for="max_rent">Max Budget Limit (₱)</label>
                                <input type="number" id="max_rent" name="max_rent" step="0.01" value="{{ old('max_rent', auth()->guard('client')->user()->max_rent) }}">
                                @error('max_rent') <span class="error-message">{{ $message }}</span> @enderror
                            </div>

                            {{-- Current Address --}}
                            <div class="form-group full-width">
                                <label for="address">Current Address</label>
                                <textarea id="address" name="address" required>{{ old('address', auth()->guard('client')->user()->address) }}</textarea>
                                @error('address') <span class="error-message">{{ $message }}</span> @enderror
                            </div>

                            {{-- Password Field --}}
                            <div class="form-group full-width">
                                <label for="password">Account Password</label>
                                <input type="password" id="password" name="password" placeholder="••••••••">
                                <span class="password-note">Leave blank if you don't wish to change your current password.</span>
                                @error('password') <span class="error-message">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('client.dashboard') }}" class="btn-cancel">Cancel</a>
                            <button type="submit" class="btn-save">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>