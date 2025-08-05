@extends('layout.app')
@push('style')
<style>
    .card {
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background: linear-gradient(to right, #006400, #00c853);
        color: white;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .modal-content {
        border-radius: 15px;
    }

    .form-label {
        font-weight: bold;
    }

    #table_user_wrapper .row:nth-child(1) {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    #table_user_filter label input {
        border-radius: 10px;
        border: 1px solid #ccc;
        padding: 5px 10px;
    }

    #table_user {
        font-size: 14px;
    }

    #table_user thead {
        background-color: #00a44e;
        color: white;
    }

    #table_user tbody tr:hover {
        background-color: #f2f2f2;
    }
</style>
@endpush
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">User & role</h1>
    </div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button"
                role="tab" aria-controls="home-tab-pane" aria-selected="true">User</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button"
                role="tab" aria-controls="profile-tab-pane" aria-selected="false">Role</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
@include('user&role.user')
        </div>
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
@include('user&role.role')
        </div>
    </div>
@endsection
