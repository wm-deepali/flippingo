

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? 'Products'); ?>

<?php $__env->stopSection(); ?>

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

    .btn.livechat {
        background: #9C27B0;
        color: white;
    }

    .btn.enquiries {
        background: #607D8B;
        color: white;
    }
</style>


<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="page-wrapper">
        <div class="listing-and-product">
            <!-- Agar Listing nahi hogi -->
            <div class="listing-product no-listing mb-4">
                <div class="create-listing-frame">
                    <button id="create-listing-btn" class="create-listing-btn">+ Create Listing</button>
                </div>
            </div>

            <!-- Agar Listing hogi -->
            <div class="listing-product has-listing">
                <!-- Summary Cards -->
                <div class="summary-cards">
                    <div class="summary-card">Published <span><?php echo e($summary['published']); ?></span></div>
                    <div class="summary-card">Pending Approval <span><?php echo e($summary['pending']); ?></span></div>
                    <div class="summary-card">Disapproved <span><?php echo e($summary['rejected']); ?></span></div>
                    <div class="summary-card">Expired <span><?php echo e($summary['expired']); ?></span></div>
                </div>


                <!-- Listing Cards -->
                <div class="listing-cards">
                    <?php $__empty_1 = true; $__currentLoopData = $submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="listing-card">
                            <?php
                                $fields = json_decode($submission['data'], true);
                                $productTitle = $fields['product_title']['value'] ?? 'No Title';
   $offeredPrice = ($fields['urgent_sale']['value'] ?? '') === 'Yes'
    ? ($fields['offered_price']['value'] ?? '0')
    : ($fields['mrp']['value'] ?? '0');

                                $summaryFields = $submission['summaryFields'] ?? null;
                              ?>
                            <?php if($submission['product_photo']): ?>
                                <img src="<?php echo e(asset('storage/' . $submission['product_photo'])); ?>" />
                            <?php else: ?>
                                <img src="<?php echo e('https://www.stockvault.net/data/2012/09/10/135306/thumb16.jpg'); ?>" alt="Product">
                            <?php endif; ?>
                            <div class="listing-info">
                                <h3><?php echo e($submission['product_title']); ?></h3>


                                <?php if(!empty($summaryFields)): ?>
                                    <?php
                                        // Filter textarea fields using array_filter
                                        $textareaFields = array_filter($summaryFields, function ($field) {
                                            return
                                                isset($field['field_id']) &&
                                                Str::startsWith($field['field_id'], 'textarea');
                                        });
                                    ?>

                                    <?php if(!empty($textareaFields)): ?>
                                        <p>
                                            <?php $__currentLoopData = $textareaFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(!empty($field['icon'])): ?>
                                                    <i class="<?php echo e($field['icon']); ?>" style="margin-right: 4px;"></i>
                                                <?php endif; ?>
                                                <?php echo e(\Illuminate\Support\Str::limit($field['value'], 200, '...')); ?>


                                                
                                                <?php if($index !== array_key_last($textareaFields)): ?>
                                                    &nbsp;|&nbsp;
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </p>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="wishlist-item-card">
                                    <?php if(!empty($summaryFields)): ?>
                                        <?php
                                            // Use array_filter when summaryFields is a plain array
                                            $textFields = array_filter($summaryFields, function ($field) {
                                                return
                                                    isset($field['field_id']) &&
                                                    Str::startsWith($field['field_id'], 'text_');
                                            });
                                          ?>

                                        <?php if(!empty($textFields)): ?>
                                            <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="wishlist-left mb-2">
                                                    <p class="m-0" style="color: green;">
                                                        <i class="<?php echo e($field['icon'] ?? ''); ?>"></i>
                                                    </p>
                                                    <div class="d-flex flex-column">
                                                        <p class="m-0" style="font-size: 16px;"><?php echo e($field['label'] ?? ''); ?></p>
                                                        <h5 class="m-0" style="color: #000; font-size: 16px;"><?php echo e($field['value'] ?? ''); ?>

                                                        </h5>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </div>

                                <div class="listing-actions">
                                    <a href="<?php echo e(route('listing.edit', $submission['id'])); ?>" class="btn edit">Edit</a>
                                    <a href="#" class="btn analytics">View Analytics</a>
                                    <a href="<?php echo e(route('listing.show', $submission['id'])); ?>" class="btn details">View Detail</a>
                                    <a href="#" class="btn livechat">Live Chat</a>
                                    <a href="<?php echo e(route('dashboard.enquiries', ['submission_id' => $submission['id']])); ?>"
                                        class="btn enquiries">
                                        Show All Enquiries
                                    </a>
                                    <button type="button" class="btn btn-danger delete-listing"
                                        data-id="<?php echo e($submission['id']); ?>">
                                        Delete
                                    </button>
                                </div>


                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="create-listing-frame">
                            <button id="create-listing-btn" class="create-listing-btn">+ Create Listing</button>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Listings Cards -->
                <!-- <div class="listing-cards">
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
                                        </div> -->



            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        // Redirect on clicking "Create Listing"
        document.getElementById("create-listing-btn").addEventListener("click", function () {
            let url = "<?php echo e(route('add-listing', ['from' => 'dashboard'])); ?>";
            window.location.href = url;
        });


        $(document).on('click', '.delete-listing', function () {
            let listingId = $(this).data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "Deleting this listing will remove all related data permanently!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "<?php echo e(route('listing.destroy', ':id')); ?>";
                    url = url.replace(':id', listingId);

                    $.ajax({
                        url: url,
                        type: "DELETE",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>"
                        },
                        success: function (res) {
                            Swal.fire({
                                icon: "success",
                                title: "Deleted!",
                                text: res.message || "Listing deleted successfully."
                            });

                            // Reload after short delay
                            setTimeout(() => location.reload(), 1000);
                        },
                        error: function (xhr) {
                            Swal.fire({
                                icon: "error",
                                title: "Error!",
                                text: xhr.responseJSON?.message || "Something went wrong, please try again."
                            });
                        }
                    });
                }
            });
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/listing/index.blade.php ENDPATH**/ ?>