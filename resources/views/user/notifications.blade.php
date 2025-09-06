@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Orders' }}
@endsection


<style>
    .notification-section {
        padding: 20px;
        font-family: Arial, sans-serif;
    }

    .notif-cards {
        display: flex;
        gap: 15px;
        margin-bottom: 50px;
    }

    .notif-card {
        flex: 1;
        padding: 15px;
        border-radius: 10px;
        text-align: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .notif-card h4 {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .notif-count {
        font-size: 22px;
        font-weight: bold;
    }

    .notif-recent {
        background: #e8f4ff;
    }

    .notif-unread {
        background: #fff3e6;
    }

    .notif-read {
        background: #eafbea;
    }

    .notif-bookmark {
        background: #f5e9ff;
    }

    .notif-controls {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .notif-filter label {
        font-weight: bold;
        margin-right: 5px;
    }

    .notif-search input {
        padding: 6px 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .notif-table {
        width: 100%;
        border-collapse: collapse;
    }

    .notif-table th,
    .notif-table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .notif-table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .notif-table tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    .notif-flag {
        background: red;
        color: #fff;
        font-size: 10px;
        padding: 2px 5px;
        border-radius: 4px;
        margin-left: 8px;
    }

    .btn-view,
    .btn-bookmark {
        padding: 5px 10px;
        margin-right: 5px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn-view {
        background: #007bff;
        color: white;
    }

    .btn-bookmark {
        background: #e7e6e2;
    }
</style>

@section('content')

    @include('user.sidebar')

    <div class="page-wrapper">
        <div class="notification-section">
            <!-- Top Cards -->
            <div class="notif-cards">
                <div class="notif-card notif-recent">
                    <h4>Recent Notifications</h4>
                    <span class="notif-count">24</span>
                </div>
                <div class="notif-card notif-unread">
                    <h4>Unread</h4>
                    <span class="notif-count">8</span>
                </div>
                <div class="notif-card notif-read">
                    <h4>Read</h4>
                    <span class="notif-count">12</span>
                </div>
                <div class="notif-card notif-bookmark">
                    <h4>Bookmarks</h4>
                    <span class="notif-count">4</span>
                </div>
            </div>

            <!-- Filter & Search -->
            <div class="notif-controls">
                <div class="notif-filter">
                    <label>Filter By:</label>
                    <select
                        style="height: 40px;border: none; border: 1px solid rgba(128, 128, 128, 0.671); border-radius: 4px;width: 150px; padding: 0px 10px;">
                        <option>Recent First</option>
                        <option>Unread</option>
                        <option>Read</option>
                        <option>Bookmarks</option>
                    </select>
                </div>
                <div class="notif-search">
                    <input type="text" placeholder="Search Notifications...">
                </div>
            </div>

            <!-- Notification Table -->
            <table class="notif-table">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Notification Detail</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>04-Sep-2025 10:30 AM</td>
                        <td>
                            <strong style="font-weight: 600;">Payment Successful</strong><br>
                            Your payment of INR 500 has been successfully processed.
                            <span class="notif-flag">NEW</span>
                        </td>
                        <td>Unread</td>
                        <td>
                            <button class="btn-view">👁</button>
                            <button class="btn-bookmark" style="color: red;"><i class="fa-solid fa-bookmark"
                                    style="color: red;"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>03-Sep-2025 05:10 PM</td>
                        <td>
                            <strong style="font-weight: 600;">Profile Updated</strong><br>
                            Your profile information has been successfully updated.
                        </td>
                        <td>Read</td>
                        <td>
                            <button class="btn-view">👁</button>
                            <button class="btn-bookmark" style="color: red;"><i class="fa-solid fa-bookmark"
                                    style="color: red;"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



        <footer class="footer text-center text-muted">
            All Rights Reserved by Adminmart. Designed and Developed by
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>


@endsection