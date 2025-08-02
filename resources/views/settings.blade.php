@extends('layouts.app')

@section('content')
<style>
    .settings-container {
        max-width: 700px;
        margin: 40px auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 32px 24px;
        display: flex;
        flex-direction: column;
        gap: 32px;
    }
    .settings-header {
        font-size: 2rem;
        font-weight: 600;
        color: #444;
        margin-bottom: 8px;
    }
    .settings-tabs {
        display: flex;
        gap: 16px;
        margin-bottom: 24px;
    }
    .settings-tab {
        padding: 8px 24px;
        border-radius: 8px 8px 0 0;
        background: #f5f7fa;
        color: #007bff;
        font-weight: 500;
        cursor: pointer;
        border: none;
        outline: none;
        transition: background 0.2s;
    }
    .settings-tab.active {
        background: #fff;
        border-bottom: 2px solid #007bff;
        color: #222;
    }
    .profile-section {
        display: flex;
        flex-direction: row;
        gap: 32px;
        align-items: flex-start;
    }
    .profile-pic-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
    }
    .profile-pic {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #e3e6ed;
        background: #f5f7fa;
    }
    .change-pic-btn {
        background: #e3e6ed;
        color: #007bff;
        border: none;
        border-radius: 6px;
        padding: 6px 18px;
        font-size: 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    .change-pic-btn:hover {
        background: #d0d6e1;
    }
    .settings-form {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 18px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .form-label {
        font-size: 0.98rem;
        color: #888;
        font-weight: 500;
    }
    .form-input {
        padding: 10px 14px;
        border: 1px solid #e3e6ed;
        border-radius: 6px;
        font-size: 1.05rem;
        background: #f9fafb;
        transition: border 0.2s;
    }
    .form-input:focus {
        border: 1.5px solid #007bff;
        outline: none;
        background: #fff;
    }
    .save-btn {
        margin-top: 18px;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 12px 0;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        width: 100%;
    }
    .save-btn:hover {
        background: #0056b3;
    }
    @media (max-width: 700px) {
        .settings-container {
            padding: 18px 4vw;
        }
        .profile-section {
            flex-direction: column;
            align-items: center;
            gap: 24px;
        }
        .settings-form {
            width: 100%;
        }
    }
</style>

<div class="settings-container">
    <div class="settings-header">Account Setting</div>
    <div class="settings-tabs">
        <button class="settings-tab active">Profile</button>
    </div>
    <form class="profile-section" method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="profile-pic-wrapper">
            <img src="{{ Auth::user()->profile_picture_url ?? asset('images/default-profile.png') }}" class="profile-pic" id="profilePicPreview" alt="Profile Picture">
            <input type="file" name="profile_picture" id="profilePicInput" accept="image/*" style="display:none" onchange="previewProfilePic(event)">
            <button type="button" class="change-pic-btn" onclick="document.getElementById('profilePicInput').click()">Change</button>
        </div>
        <div class="settings-form">
            <div class="form-group">
                <label class="form-label" for="name">Name</label>
                <input class="form-input" type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="form-input" type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" required>
            </div>
            <div class="form-group">
                <label class="form-label" for="phone">Phone</label>
                <input class="form-input" type="text" id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="website">Website</label>
                <input class="form-input" type="url" id="website" name="website" value="{{ old('website', Auth::user()->website) }}">
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input class="form-input" type="password" id="password" name="password" placeholder="Leave blank to keep current">
            </div>
            <button type="submit" class="save-btn">Save</button>
        </div>
    </form>
</div>
<script>
    function previewProfilePic(event) {
        const reader = new FileReader();
        reader.onload = function(){
            document.getElementById('profilePicPreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
