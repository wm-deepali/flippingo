@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Products' }}
@endsection

<style>
    /* ====== Common ====== */
    .listing-product {
        font-family: Arial, sans-serif;
    }

    /* ====== No Listing ====== */
    .create-listing-frame {
        border: 2px dashed #ccc;
        padding: 60px;
        text-align: center;
        border-radius: 12px;
        background: #fafafa;
    }

    .create-listing-btn {
        background: #4CAF50;
        color: #fff;
        border: none;
        padding: 14px 28px;
        font-size: 16px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
    }

    .create-listing-btn:hover {
        background: #45a049;
    }

    /* ====== Summary Cards ====== */
    .summary-cards {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .summary-card {
        flex: 1;
        background: #f9f9f9;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        font-weight: bold;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .summary-card span {
        display: block;
        margin-top: 8px;
        font-size: 20px;
        color: #4CAF50;
    }

    /* ====== Listing Cards ====== */

    .listing-cards {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .listing-card {
        display: flex;
        align-items: stretch;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: 0.3s;
    }

    .listing-card:hover {
        transform: translateY(-4px);
    }

    .listing-card img {
        width: 230px;
        height: auto;
        object-fit: cover;
    }

    .listing-info {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* content top, buttons bottom */
        padding: 20px;
        flex: 1;
    }

    .listing-info h3 {
        margin: 0 0 10px;
        font-size: 20px;
    }

    .listing-info p {
        font-size: 14px;
        color: #555;
        margin-bottom: 10px;
        line-height: 1.5;
    }

    .key-points {
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin: 0 0 20px;
        padding-left: 18px;
        color: #333;
        font-size: 14px;
    }

    .key-points li {
        list-style: none;
        margin-bottom: 6px;
    }

    .listing-actions {
        display: flex;
        gap: 10px;
        margin-top: auto;
        /* ensures buttons stick at bottom */
    }

    .btn {
        padding: 8px 14px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .btn.edit {
        background: #2196F3;
        color: white;
    }

    .btn.analytics {
        background: #FF9800;
        color: white;
    }

    .btn.details {
        background: #4CAF50;
        color: white;
    }
</style>


@section('content')

    @include('user.sidebar')

    <div class="page-wrapper">
        <div class="listing-and-product">
            <!-- Agar Listing nahi hogi -->
            <div class="listing-product no-listing mb-4">
                <div class="create-listing-frame">
                    <button class="create-listing-btn">+ Create Listing</button>
                </div>
            </div>

            <!-- Agar Listing hogi -->
            <div class="listing-product has-listing">
                <!-- Summary Cards -->
                <div class="summary-cards">
                    <div class="summary-card">Active Listings <span>12</span></div>
                    <div class="summary-card">Drafts <span>3</span></div>
                    <div class="summary-card">Pending Approval <span>2</span></div>
                    <div class="summary-card">Disapproved <span>1</span></div>
                </div>

                <!-- Listings Cards -->
                <div class="listing-cards">
                    <div class="listing-card">
                        <img src="https://www.stockvault.net/data/2012/09/10/135306/thumb16.jpg" alt="Product">
                        <div class="listing-info">
                            <h3>Course Title or Product Name</h3>
                            <p>
                                This comprehensive course is designed to give learners an in-depth understanding of the
                                subject matter.
                                Covering all essential modules with practical examples, case studies, and real-world
                                applications, it helps
                                students develop critical skills, improve knowledge retention, and apply concepts
                                effectively.
                                Whether you are a beginner or an advanced learner, this program ensures a structured
                                approach for your growth.
                            </p>
                            <ul class="key-points">
                                <li>✔ Interactive video lessons</li>
                                <li>✔ Downloadable resources</li>
                                <li>✔ Quizzes and assignments</li>
                                <li>✔ Lifetime access</li>
                            </ul>

                            <div class="listing-actions">
                                <button class="btn edit">Edit</button>
                                <button class="btn analytics">View Analytics</button>
                                <button class="btn details">View Detail</button>
                            </div>
                        </div>
                    </div>

                    <div class="listing-card">
                        <img src="https://www.stockvault.net/data/2012/09/10/135306/thumb16.jpg" alt="Product">
                        <div class="listing-info">
                            <h3>Another Course Name</h3>
                            <p>
                                This training program introduces participants to essential concepts with a practical focus
                                on application.
                                The course ensures comprehensive coverage of the fundamentals while progressively advancing
                                to complex topics.
                                It is crafted to help professionals, students, and enthusiasts gain confidence, improve
                                efficiency, and achieve
                                measurable results by applying knowledge to real-world scenarios with guidance from experts.
                            </p>
                            <ul class="key-points">
                                <li>✔ Beginner to advanced modules</li>
                                <li>✔ Certification upon completion</li>
                                <li>✔ Hands-on projects</li>
                                <li>✔ 24/7 support</li>
                            </ul>

                            <div class="listing-actions">
                                <button class="btn edit">Edit</button>
                                <button class="btn analytics">View Analytics</button>
                                <button class="btn details">View Detail</button>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>











    </div>
@endsection

@push('scripts')

    <script>
        // Example: Toggle subscription condition
        let hasSubscription = true; // backend se check karna hoga

        if (hasSubscription) {
            document.getElementById("withSubscription").style.display = "flex";
            document.getElementById("noSubscription").style.display = "none";
        } else {
            document.getElementById("withSubscription").style.display = "none";
            document.getElementById("noSubscription").style.display = "block";
        }
        function openRenewModal() {
            document.getElementById("renewModal").style.display = "flex";
        }
        function closeRenewModal() {
            document.getElementById("renewModal").style.display = "none";
        }

    </script>

@endpush