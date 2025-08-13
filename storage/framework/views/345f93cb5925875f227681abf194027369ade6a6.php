<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"-->
<!--    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">-->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    body {
        background-color: #f8f9fa !important;
    }

    /*.dropdown-menu {*/
    /*    -webkit-box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);*/
    /*    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;*/
    /*    border: 0 solid #e9ecef !important;*/
    /*    font-size: 14px !important;*/
    /*    margin: 8px 0 0 !important;*/
    /*    border-radius: 0px !important;*/
    /*    background-color: rgb(30 30 30 / 90%) !important;*/
    /*}*/

    /*.dropdown-toggle::after {*/
    /*    display: none !important;*/
    /*}*/

    /*.primary-menu .navbar .dropdown-large-menu ul li {*/
    /*    background: black;*/
    /*}*/

    /*.list-group-item.active {*/
    /*    background-color: #656565 !important;*/
    /*    border-color: #656565 !important;*/
    /*}*/

    /*.nav-item a {*/
    /*    color: gray !important;*/
    /*}*/

    .reset-card {
        width: 100%;
        height: 70px;
        border-radius: 12px;
        background-color: white;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
        align-items: center;
    }

    .reset-card button {
        background: none;
        border: none;
        color: red;
        border-bottom: 1px solid red;
        padding-bottom: 4px;
    }

    .calculation-card {
        width: 100%;
        height: auto;
        border-radius: 12px;
        background-color: white;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        padding: 30px 20px;
    }

    .color-print {
        width: 100%;
        height: auto;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .color-print1 {
        width: 100%;
        height: auto;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 10px;
    }

    .print-color {
        width: 100%;
        height: 38px;
        border: 2px solid #e0e0e0 !important;

        border-radius: .375rem !important;
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .print-color.active,
    .print-color:focus {
        color: #495057;
        background-color: #f8f3f3;
        border: 2px solid #6bd3cc !important;
        outline: 0;
        /*box-shadow: 0 0 0 0.1rem #6bd3cc !important;*/
    }

    .print-color:hover {
        box-shadow: 0 0 0 0.2rem #6bd3cc82 !important;
    }

    .print-color p {
        margin: 0px;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .form-row-section {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .form-row-section1 {
        width: 100%;
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .s-row {
        width: 100%;
    }

    .size-btn button {
        background: none;
        border: none;
        color: red;
    }

    .paper-type-section {
        width: 100%;
        height: 200px;
        display: flex;
        flex-direction: column;
        gap: 7px;
        border: 1px solid rgb(185, 185, 185);
        padding: 10px;
        border-radius: 7px;
        overflow: hidden;
        overflow-y: scroll;
        padding-right: 8px;
    }

    .paper-type-section button {
        text-align: left;
    }

    .paper-type-section button.active,
    .paper-type-section button:focus {
        color: #495057;
        background-color: #fff;
        border-color: #80bdff;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .paper-type-options::-webkit-scrollbar {
        width: 8px;
    }

    .paper-type-options::-webkit-scrollbar-track {
        background: #f0f0f0;
        border-radius: 5px;
    }

    .paper-type-options::-webkit-scrollbar-thumb {
        background: #007bff;
        border-radius: 5px;
    }

    .paper-type-options::-webkit-scrollbar-thumb:hover {
        background: #0056b3;
    }

    .paper-type-options {
        scrollbar-color: #007bff #f0f0f0;
        scrollbar-width: thin;
    }

    .choose-binding {
        width: 100%;
        height: auto;
        display: flex;
        flex-direction: column;
        /* justify-content: center; */
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }

    .choose-binding.active {
        background-color: #fff;
        border: 1px solid #80bdff;
        border-radius: 6px;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .choose-binding img {
        width: 100%;
        border: 1px solid gray;
        border-radius: 6px;
        padding: 3px;
    }

    .help-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        border: 1px solid #dbdbdb;
        color: #b7b8b9;
        font-weight: bold;
        font-size: 11px;
        cursor: pointer;
        margin-left: 5px;
        padding-left: 2px;
        padding-top: 1px;

    }

    .s-row label {
        font-size: 14px;
        font-weight: 600;
    }

    .form-label {
        display: flex;
        align-items: center;
        font-size: 14px;
        font-weight: 600;
        gap: 5px;
    }

    .page-slider {
        width: 100%;
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .page-slider input[type="range"] {
        -webkit-appearance: none;
        width: 100%;
        height: 10px;
        background: #f0f0f0;
        border-radius: 5px;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .page-slider input[type="range"]:hover {
        opacity: 1;
    }

    .page-slider input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: #17a2b8;
        border-radius: 50%;
        cursor: pointer;
    }

    .page-slider input[type="range"]::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: #17a2b8;
        border-radius: 50%;
        cursor: pointer;

    }

    .page-slider input[type="range"]::-webkit-slider-runnable-track {
        background: linear-gradient(to right, #007bff 0%, #007bff var(--value, 0%), #f0f0f0 var(--value, 0%), #f0f0f0 100%);
        height: 10px;
        border-radius: 5px;

    }

    .page-slider input[type="range"]::-moz-range-track {
        background: linear-gradient(to right, #007bff 0%, #007bff var(--value, 0%), #f0f0f0 var(--value, 0%), #f0f0f0 100%);
        height: 10px;
        border-radius: 5px;

    }

    .page-slider .range-value {
        margin-top: 5px;
        text-align: center;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .page-slider button {
        background: none;
        border: none;
        color: rgb(0, 0, 0);
        /* border-bottom: 1px solid red; */
        padding-bottom: 4px;
        cursor: pointer;
        font-size: 16px;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .range-value button {
        background-color: rgb(189, 187, 187);
        padding: 5px;
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .right-side-section {
        width: 100%;
        height: auto;
        border-radius: 12px;
        background-color: white;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        padding: 20px 20px;
        position: sticky;
        top: 0px;
    }

    .estimate-card.active {
        border: 2px solid #6bd3cc;
        background-color: #f8f3f3;
    }

    .estimate-card.active .circle-point {
        border: 2px solid #6bd3cc;
        background-color: white;
    }


    .estimate-card {
        width: 100%;
        min-height: 15px;
        border: 1px solid gray;
        border-radius: 14px;
        display: flex;
        align-items: center;
        padding: 15px;
        gap: 20px;

    }

    .circle-point {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 1px solid gray;
    }

    .estimate-div {
        width: 90%;
        height: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .line-y {
        width: 1px;
        height: 50px;
        background-color: gray;
    }

    .line-x {
        width: 100%;
        height: 1px;
        background-color: gray;

    }

    .est-card {
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .disci i {
        color: green;
        margin-right: 5px;
    }

    .disci p {
        font-size: 13px;
    }

    .addtobtn button {
        width: 100%;
        background-color: #c48e3d;
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 4px;
        height: 40px;
        font-size: 18px;
    }

    .addtobtn button:hover {
        background-color: #e0aa0b;
    }

    .note-dis {
        width: 100%;
        display: flex;
        justify-content: space-between;

    }

    .note-dis p {
        font-size: 12px;
    }

    .extra-card {
        width: 100%;
        height: auto;
        border-radius: 12px;
        background-color: white;
        box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
        padding: 20px 20px;
        display: flex;
        gap: 20px;
    }

    .extra-card-details {
        display: flex;
        flex-direction: column;
        /* justify-content: space-between; */
    }

    .extra-card-details p {
        font-size: 13px;
        margin-top: 5px;
    }

    .page-slider {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* Adjust slider height and remove unwanted margins */
    .page-slider input[type="range"] {
        -webkit-appearance: none;
        width: 90%;
        /* adjust as needed */
        height: 6px;
        background: #ccc;
        border-radius: 5px;
        outline: none;
        margin: 0;
        /* prevents misalignment */
        padding: 0;
        vertical-align: middle;
    }

    /* For WebKit browsers (Chrome, Safari) */
    .page-slider input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #2552a5;
        cursor: pointer;
        margin-top: -5px;
        /* Adjust to center thumb vertically */
        position: relative;
    }

    /* For Firefox */
    .page-slider input[type="range"]::-moz-range-thumb {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #000;
        cursor: pointer;
    }

    /* Button styling (optional) */
    .range-value button {
        width: 30px;
        height: 30px;
        border: none;
        background-color: #eee;
        border-radius: 4px;
        font-size: 20px;
        cursor: pointer;

    }

    .zoom-section {
        width: 30px;
        height: 30px;
        background-color: #ffffff;
        position: relative;
        bottom: 0px;
        right: 0px;
        z-index: 100;
        margin-top: -30px;
        float: inline-end;
        border-top-left-radius: 3px;

    }

    .zoom-section1 {
        width: 20px;
        height: 20px;
        background-color: #ffffff;
        position: relative;
        right: -1px;
        right: 3px;
        margin-top: -31px;
        margin-top: -22px;
        float: inline-end;
        border-top-left-radius: 3px;
    }

    .zoomicon {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: rgb(170, 170, 170);
    }

    .btn-light {
        background-color: #f8f9fa !important;
        color: #212529 !important;
        border-color: #f8f9fa !important;
    }

    .btn-light.active,
    .btn-light:focus,
    .btn-light:hover {
        background-color: #e2e6ea !important;
        /* Slight hover */
        color: #212529 !important;
    }

    .btn-link {
        background-color: transparent !important;
    }

    .btn {
        border: none !important;
    }

    .selectable-proof-option {
        transition: 0.2s ease-in-out;
        border-radius: 12px;
        /* curved edges */
        border: 1px solid #ccc;
    }

    .selectable-proof-option.active {
        border-color: #6bd3cc !important;
        background-color: #f8f3f3 !important;
    }

    input[type="checkbox"].form-check-input {
        display: inline-block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    .form-check-input:checked {
        background-color: #6bd3cc;
        border: 1px solid #17a2b8 !important;
    }

    .attribute-wrapper.disabled .attribute-values {
        opacity: 0.5;
        pointer-events: none;
    }

    .attribute-wrapper .attribute-condition-note {
        color: #ff0000 !important;
        /* Bootstrap 'danger' red */
        font-size: 0.8rem;
        margin-bottom: 0px;
        margin-top: 0.25rem;
        /* aligns with checkbox/label spacing */
    }

    .attribute-wrapper.disabled label {
        color: #888 !important;
    }

    .modal-content {
        background: #ffffff;
    }
</style>
<style>
    @media  only screen and (max-width: 600px) {
        .tab-buttons {
            display: flex !important;
            gap: 0.5rem !important;
            margin-bottom: 1rem !important;
            overflow: scroll !important;
        }

        .tab-buttons::-webkit-scrollbar {
            display: none !important;

        }

        .primary-menu .navbar {
            display: none;
        }
    }
</style>

<div class="row">
    <div class="col-md-7">
        <div class="reset-card">
            <h5>Create Your <?php echo e($subcategory->name ?? "Booklets"); ?></h5>
            <button>Reset</button>
        </div>
        <form>
            <?php if(!empty($attributeGroups) && count($attributeGroups)): ?>
                <?php
                    $mainGroup = collect($attributeGroups)->first(function ($group) {
                        return str_contains(strtolower($group['group_name']), 'main attributes');
                    });
                    $otherGroups = collect($attributeGroups)->reject(function ($group) {
                        return str_contains(strtolower($group['group_name']), 'main attributes');
                    });
                ?>
                <div class="calculation-card mt-3">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="quantityInput" class="form-label">
                                Quantity
                                <span class="help-circle" data-label="Quantity" data-toggle="modal"
                                    data-target="#helpModal">?</span>
                            </label>
                            <input type="number" class="form-control" id="quantityInput" placeholder="100"
                                value="<?php echo e($quantityDefaults['default'] ?? 100); ?>" min="<?php echo e($quantityDefaults['min'] ?? 1); ?>"
                                max="<?php echo e($quantityDefaults['max'] ?? 10000); ?>">
                            <div class="invalid-feedback d-none" id="quantityError">
                                Quantity must be between <?php echo e($quantityDefaults['min'] ?? 1); ?> and
                                <?php echo e($quantityDefaults['max'] ?? 10000); ?>.
                            </div>
                        </div>


                        
                        <?php if(isset($mainGroup['attributes'])): ?>
                            <?php $__currentLoopData = $mainGroup['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('front.attribute-block', ['attribute' => $attribute], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>

                    <?php if($pagesDraggerRequired): ?>
                        <div id="composite-draggers" class="mt-3">
                            
                        </div>
                    <?php endif; ?>

                    <?php if($pagesDraggerRequired): ?>
                        <div class="form-row-section1 pages-dragger-wrapper">
                            <div class="s-row mb-3 pages-dragger">
                                <label>Pages
                                    <span class="help-circle" data-label="Pages" data-toggle="modal"
                                        data-target="#helpModal">?</span>
                                </label>
                                <div class="page-slider">
                                    <input type="range" name="pages[]" min="<?php echo e($pagesDefaults['min'] ?? 1); ?>"
                                        max="<?php echo e($pagesDefaults['max'] ?? 840); ?>" value="<?php echo e($pagesDefaults['default'] ?? 1); ?>"
                                        step="1" id="pageSlider">
                                    <div class="range-value">
                                        <button type="button">-</button>
                                        <span id="pageValue"><?php echo e($pagesDefaults['default'] ?? 1); ?></span>
                                        <button type="button">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
                
                <?php $__currentLoopData = $otherGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $groupKey = \Illuminate\Support\Str::slug($group['group_name'], '_');
                        $isToggleable = $group['is_toggleable'] ?? false;
                    ?>

                    <div class="calculation-card mt-3">
                        <?php if($isToggleable): ?>
                            

                            <div class="form-check form-check-inline">
                                <input class="form-check-input group-toggle" style="border: 1px solid #212529" type="checkbox"
                                    id="toggle_<?php echo e($groupKey); ?>" data-target="#section_<?php echo e($groupKey); ?>">
                                <label class="form-check-label" for="toggle_<?php echo e($groupKey); ?>"><?php echo e($group['group_name']); ?></label>
                            </div>
                        <?php else: ?>
                            
                            <h5 class="mb-2"><?php echo e($group['group_name']); ?></h5>
                        <?php endif; ?>
                        <div class="mt-3 <?php echo e($isToggleable ? 'd-none' : ''); ?>" id="section_<?php echo e($groupKey); ?>">
                            <div class="row">
                                <?php $__currentLoopData = $group['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        // Disable default selection if group is toggleable
                                        if ($group['is_toggleable'] ?? false) {
                                            $attribute['values'] = $attribute['values']->map(function ($val) {
                                                $val['original_is_default'] = $val['is_default'];
                                                $val['is_default'] = false;
                                                return $val;
                                            });
                                        }
                                        // dd($attribute); // check to confirm is_default: false now
                                    ?>

                                    <?php echo $__env->make('front.attribute-block', ['attribute' => $attribute], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>
        </form>
    </div>
    <div class="col-md-5">
        <div class="right-side-section">
            <?php
                use Carbon\Carbon;
            ?>

            <?php if($deliveryChargesRequired): ?>
                <h5>Choose Price & Delivery Date</h5>
                <?php $__currentLoopData = $deliveryCharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $deliveryDate = Carbon::now()->addDays($option['no_of_days']);
                        $formattedDate = $deliveryDate->format('D, jS M');
                        $detailsHtml = $option['details'] ?? null;
                        $title = $option['title'] ?? null;
                    ?>


                    <div class="estimate-card estimate-option <?php echo e($option['is_default'] ? 'active' : 'mt-3'); ?>"
                        data-price="<?php echo e($option['price']); ?>" data-date="<?php echo e($formattedDate); ?>" data-id="<?php echo e($option['id']); ?>">
                        <div class="circle-point"></div>
                        <div class="est-card">

                            <div class="estimate-div">
                                <div class="<?php echo e($option['is_default'] ? 'ast-active' : ''); ?>">

                                    <p class="m-0 text-black">Estimated Delivery:</p>
                                    <h4 class="text-black mb-1"><?php echo e($formattedDate); ?></h4>
                                    <?php if($title): ?>
                                        <div class="title text-muted small d-none"><?php echo e($title); ?></div>
                                    <?php endif; ?>

                                </div>
                                <div class="line-y"></div>
                                <div>
                                    <h4 class="text-black final-price">
                                        £<?php echo e(number_format($option['price'], 2)); ?></h4>
                                </div>
                            </div>

                            <?php if(!empty($detailsHtml)): ?>
                                <div class="line-x detail-section d-none"></div>
                                <div class="disci text-black detail-section d-none">
                                    <?php echo $detailsHtml; ?>

                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="text-black mb-3">
                    <h4 class="final-price">£0.00</h4>
                </div>
            <?php endif; ?>

            <?php if($proofReadingRequired && !empty($proofReadings)): ?>
                <div class="form-row-section1 mt-3">
                    <div class="s-row mb-3">
                        <label for="proof-reading" style="    font-size: 1.25rem;">Proof Reading</label>
                        <div class="d-flex flex-wrap gap-3">
                            <?php $__currentLoopData = $proofReadings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($option['proof_type']) && isset($option['price'])): ?>
                                    <div class="selectable-proof-option border rounded p-2 text-center"
                                        data-id="<?php echo e($option['id']); ?>" data-value="<?php echo e($option['proof_type']); ?>"
                                        data-price="<?php echo e($option['price']); ?>"
                                        style="width: 140px; cursor: pointer; background-color: #f9f9f9;">
                                        <strong style="font-size: 13px;"><?php echo e($option['proof_type']); ?></strong>
                                        <div class="text-muted" style="font-size: 12px;">
                                            £<?php echo e(number_format($option['price'], 2)); ?>

                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>



            <div class="addtobtn mt-3">
                <button id="addToCartBtn" data-route="<?php echo e(route("cart.store")); ?>"
                    data-subcategory-id="<?php echo e($subcategory->id); ?>">Add to Cart</button>
                <?php if($deliveryChargesRequired): ?>
                    <div class="note-dis">
                        <p>Delivery dates are estimated.</p>
                    </div>
                <?php endif; ?>

            </div>

        </div>

        <!--<div class="extra-card mt-3">-->
        <!--    <img-->
        <!--        src="https://d1e8vjamx1ssze.cloudfront.net/coloratura/images/price-calculator/tooltips_and_thumbnails/print-template-thumbnail.png" />-->
        <!--    <div class="extra-card-details">-->
        <!--        <h6 class="m-0">Print on Demand</h6>-->
        <!--        <p>Download the free PDF template we created for your specifications.</p>-->
        <!--        <a href="">Get a Qoute</a>-->
        <!--    </div>-->
        <!--</div>-->
        <!--<div class="extra-card mt-3">-->
        <!--    <img-->
        <!--        src="https://d1e8vjamx1ssze.cloudfront.net/coloratura/images/price-calculator/tooltips_and_thumbnails/print-template-thumbnail.png" />-->
        <!--    <div class="extra-card-details">-->
        <!--        <h6 class="m-0">Print on Demand</h6>-->
        <!--        <p>Download the free PDF template we created for your specifications.</p>-->
        <!--        <a href="">Get a Qoute</a>-->
        <!--    </div>-->
        <!--</div>-->
    </div>
</div>

<!-- Bootstrap 4 Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="helpModalLabel">Help</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="helpModalBody">
                <!-- Dynamic content will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Image Zoom Modal -->
<div class="modal fade" id="imageZoomModal" tabindex="-1" aria-labelledby="imageZoomModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageZoomModalLabel">Image Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="zoomedImage" src="" class="img-fluid" alt="Zoomed Image" />
            </div>
        </div>
    </div>
</div>


<script>
    const subcategoryId = <?php echo e($subcategory->id); ?>;
    const attributeConditions = <?php echo json_encode($conditionsMap, 15, 512) ?>;
    const debouncedCalculateTotalPrice = debounce(calculateTotalPrice, 300);
    const compositeMap = <?php echo json_encode($compositeMap ?? [], 15, 512) ?>;
    const compositeDraggerValues = <?php echo json_encode($compositeDraggerValues ?? [], 15, 512) ?>;
    const pageRangeConfig = {
        min: <?php echo e($pagesDefaults['min'] ?? 1); ?>,
        max: <?php echo e($pagesDefaults['max'] ?? 840); ?>,
        default: <?php echo e($pagesDefaults['default'] ?? 1); ?>

    };
    // const defaultPages = $defaultPages;

    // to zoom the image section
    $(document).on('click', '.zoomicon', function () {
        const imageUrl = $(this).data('image');
        $('#zoomedImage').attr('src', imageUrl);
    });

    document.getElementById('quantityInput').addEventListener('input', function () {
        const input = this;
        const min = parseInt(input.min);
        const max = parseInt(input.max);
        const value = parseInt(input.value);
        const errorDiv = document.getElementById('quantityError');

        if (value < min || value > max) {
            input.classList.add('is-invalid');
            errorDiv.classList.remove('d-none');
        } else {
            input.classList.remove('is-invalid');
            errorDiv.classList.add('d-none');
        }
    });


    function forceSliderRedraw() {
        const $slider = $('#pageSlider');
        const slider = $slider[0]; // get DOM element
        const value = parseFloat($slider.val()) || 0;
        const min = parseFloat($slider.attr('min')) || 0;
        const max = parseFloat($slider.attr('max')) || 100;

        const percent = ((value - min) / (max - min)) * 100;

        // Method 1: For CSS using --value
        slider.style.setProperty('--value', `${percent}%`);

        // Method 2: For CSS using background linear-gradient directly
        slider.style.background = `linear-gradient(to right, #007bff 0%, #007bff ${percent}%, #ddd ${percent}%, #ddd 100%)`;
    }


    function debounce(func, delay) {
        let timer;
        return function (...args) {
            clearTimeout(timer);
            timer = setTimeout(() => func.apply(this, args), delay);
        };
    }

    function calculateTotalPrice() {
        const quantity = parseInt($('#quantityInput').val()) || 1;
        // const pages = parseInt($('#pageSlider').val()) || 32;

        let selectedAttributes = {};

        $('.attribute-wrapper .active').each(function () {
            const attrId = $(this).data('attribute-id');
            const valueId = $(this).data('value-id');
            if (attrId && valueId) selectedAttributes[attrId] = valueId;
        });

        $('select.custom-select').each(function () {
            const selected = $(this).find('option:selected');
            const attrId = selected.data('attribute-id');
            const valueId = selected.data('value-id');
            if (attrId && valueId) selectedAttributes[attrId] = valueId;
        });

        // Include select_area attributes (length and width)
        $('.attribute-wrapper').each(function () {
            const attrId = $(this).data('attribute-id');
            const isRequired = $(this).data('is-required');

            // Only for select_area input type
            const $lengthInput = $(this).find(`input[name="attributes[${attrId}][length]"]`);
            const $widthInput = $(this).find(`input[name="attributes[${attrId}][width]"]`);

            if ($lengthInput.length > 0 && $widthInput.length > 0) {
                const length = parseFloat($lengthInput.val());
                const width = parseFloat($widthInput.val());

                if (!isNaN(length) && !isNaN(width)) {
                    selectedAttributes[attrId] = { length, width };
                } else if (isRequired) {
                    // If required and missing, optionally mark as invalid
                    $lengthInput.addClass('is-invalid');
                    $widthInput.addClass('is-invalid');
                }
            }
        });



        document.querySelectorAll('.attribute-wrapper').forEach(wrapper => {
            const attrId = wrapper.getAttribute('data-attribute-id');
            const inputType = wrapper.getAttribute('data-input-type'); // You may need to add this if missing
            const isRequired = wrapper.getAttribute('data-is-required') === '1';

            if (wrapper.querySelector('.area-input')) {
                // It's a select_area type
                const lengthInput = wrapper.querySelector(`[id^="length_"]`);
                const widthInput = wrapper.querySelector(`[id^="width_"]`);
                const area = parseFloat(lengthInput.value || 0) * parseFloat(widthInput.value || 0);

                selectedAttributes[attrId] = {
                    type: 'select_area',
                    length: parseFloat(lengthInput.value || 0),
                    width: parseFloat(widthInput.value || 0),
                    area: parseFloat(area.toFixed(2))
                };

            } else {
                // Handle other input types...
            }
        });

        // console.log("selectedAttributes", selectedAttributes);

        let pages = 0;
        let compositePages = {}; // { value_id: { 'Cover': 32, 'Inner': 64 } }

        const $compositeSliders = $('.composite-slider');

        if ($compositeSliders.length > 0) {
            // Get selected composite value ID
            let compositeValueId = null;


            $('.attribute-wrapper .active').each(function () {
                const valueId = $(this).data('value-id');
                if (compositeMap[valueId]) {
                    compositeValueId = valueId;
                }
            });

            $('select.custom-select').each(function () {
                const selected = $(this).find('option:selected');
                const valueId = selected.data('value-id');
                if (compositeMap[valueId]) {
                    compositeValueId = valueId;
                }
            });
            if (compositeValueId) {
                const valueObj = compositeDraggerValues.find(val => val.id === compositeValueId);
                const components = valueObj?.components || [];

                let pageBreakdown = {};

                $compositeSliders.each(function () {
                    const index = parseInt($(this).data('index')); // 1-based index
                    const label = components[index - 1] || `Part ${index}`;
                    const value = parseInt($(this).val()) || 0;

                    pageBreakdown[label] = value;
                });

                compositePages[compositeValueId] = pageBreakdown;
            }
        } else {
            pages = parseInt($('#pageSlider').val()) || 32;
        }



        $.ajax({
            url: '<?php echo e(route('calculate.price')); ?>',
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                quantity,
                pages,
                attributes: selectedAttributes,
                composite_pages: compositePages,
                subcategory_id: subcategoryId,

            },
            success: function (res) {
                if (res.success) {
                    const calculatedPrice = parseFloat(res.total_price) || 0;

                    const selectedProofOption = $('.selectable-proof-option.active');
                    const proofPrice = parseFloat(selectedProofOption.data('price')) || 0;

                    const total = calculatedPrice + proofPrice;
                    const formattedTotal = '£' + total.toFixed(2);
                    const estimateCards = $('.estimate-card');

                    if (estimateCards.length > 0) {
                        estimateCards.each(function () {
                            const card = $(this);
                            const deliveryCharge = parseFloat(card.data('price')) || 0;
                            const cardTotal = deliveryCharge + total;
                            const formattedCardTotal = '£' + cardTotal.toFixed(2);
                            card.find('.final-price').text(formattedCardTotal);
                        });
                    } else {
                        // Fallback: no estimate card, update global/normal final-price
                        $('.final-price').text(formattedTotal);
                    }

                    // $('.estimate-card').each(function () {
                    //     const card = $(this);
                    //     const deliveryCharge = parseFloat(card.data('price')) || 0;

                    //     const selectedProofOption = $('.selectable-proof-option.active');
                    //     const proofPrice = parseFloat(selectedProofOption.data('price')) || 0;

                    //     const total = deliveryCharge + calculatedPrice + proofPrice;
                    //     const formattedTotal = '£' + total.toFixed(2);

                    //     card.find('.final-price').text(formattedTotal);
                    // });
                }
            },

            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }


    $(function () {
        const compositeMap = <?php echo json_encode($compositeMap ?? [], 15, 512) ?>;
        const compositeDraggerValues = <?php echo json_encode($compositeDraggerValues ?? [], 15, 512) ?>;

        function renderCompositeDraggers(valueId) {
            const count = compositeMap[valueId] ?? 0;
            const valueObj = compositeDraggerValues.find(val => val.id === valueId);
            const componentLabels = valueObj?.components || [];

            const $container = $('#composite-draggers');
            const $baseWrapper = $('.pages-dragger-wrapper');

            if (count > 1) {
                $baseWrapper.hide();
            } else {
                $baseWrapper.show();
                $container.empty();
                return;
            }

            $container.empty();
            $container.find('.composite-slider').each(function () {
                updateSliderFill(this); // apply fill on load
            });

            for (let i = 1; i <= count; i++) {
                const label = componentLabels[i - 1] ? `Pages ${componentLabels[i - 1]}` : `Pages ${i}`;
                $container.append(`
        <div class="form-row-section1">
            <div class="s-row mb-3">
                <label>${label}
                    <span class="help-circle" data-label="${label}" data-toggle="modal"
                        data-target="#helpModal">?</span>
                </label>
                <div class="page-slider">
                    <input 
                        type="range" 
                        name="composite_pages[]" 
                        min="${pageRangeConfig.min}" 
                        max="${pageRangeConfig.max}" 
                        value="${pageRangeConfig.default}" 
                        step="1"
                        class="composite-slider" 
                        data-index="${i}">
                    <div class="range-value">
                        <button type="button" class="decrease">-</button>
                        <span class="composite-value">${pageRangeConfig.default}</span>
                        <button type="button" class="increase">+</button>
                    </div>
                </div>
            </div>
        </div>
    `);
            }

            // ✅ After loop: apply fill effect to new sliders
            $container.find('.composite-slider').each(function () {
                updateSliderFill(this);
            });
        }

        function renderCompositeFromCurrentSelection() {
            let compositeValueId = null;

            $('.attribute-wrapper .active').each(function () {
                const valueId = $(this).data('value-id');
                if (compositeMap[valueId]) {
                    compositeValueId = valueId;
                }
            });

            $('select.custom-select').each(function () {
                const selected = $(this).find('option:selected');
                const valueId = selected.data('value-id');
                if (compositeMap[valueId]) {
                    compositeValueId = valueId;
                }
            });

            if (compositeValueId) {
                renderCompositeDraggers(compositeValueId);
            } else {
                $('#composite-draggers').empty();
                $('.pages-dragger-wrapper').show();
            }
        }

        $(document).on('click', '.attr-select, .print-color, .choose-binding', function () {
            const $this = $(this);
            const $wrapper = $this.closest('.attribute-wrapper');
            const isRequired = $wrapper.data('is-required');

            const wasActive = $this.hasClass('active');

            // If already selected and NOT required → unselect
            if (wasActive && !isRequired) {
                $this.removeClass('active').removeAttr('data-selected');

                const attrId = $wrapper.data('attribute-id');

                // Clear image preview if exists
                const previewImgSelector = `#preview-image-${attrId}`;
                if ($(previewImgSelector).length) {
                    $(previewImgSelector).attr('src', '<?php echo e(asset("storage/default-preview.png")); ?>');
                }

                handleAttributeConditions(attrId, null);
                renderCompositeFromCurrentSelection();
                calculateTotalPrice();

                return; // Exit early
            }

            // If required OR not active → select normally
            $wrapper.find('.attr-select, .print-color, .choose-binding')
                .removeClass('active')
                .removeAttr('data-selected');

            $this.addClass('active').attr('data-selected', 'true');

            const attrId = $wrapper.data('attribute-id');
            const valueId = $this.data('value-id');

            // ✅ Update image preview if exists
            const previewImgSelector = `#preview-image-${attrId}`;
            const newImage = $this.data('image');
            if (newImage && $(previewImgSelector).length) {
                $(previewImgSelector).attr('src', newImage);
            }

            handleAttributeConditions(attrId, valueId);
            renderCompositeFromCurrentSelection();
            calculateTotalPrice();
        });

        function convertArea(length, width, unit) {
            let area = length * width;
            return area;
        }

        function updateAreaAndPrice(attributeId) {
            const length = parseFloat(document.getElementById(`length_${attributeId}`).value) || 0;
            const width = parseFloat(document.getElementById(`width_${attributeId}`).value) || 0;
            const unit = document.getElementById(`length_${attributeId}`).dataset.areaUnit;

            const area = convertArea(length, width, unit);
            document.getElementById(`area_${attributeId}`).value = area.toFixed(2);

            // Trigger price calculation
            if (typeof calculateTotalPrice === "function") {
                calculateTotalPrice();
            }
        }

        document.querySelectorAll('.area-input').forEach(function (input) {
            input.addEventListener('input', function () {
                const attrId = this.dataset.attributeId;
                updateAreaAndPrice(attrId);
            });
        });


        $(document).on('change', 'select.custom-select', function () {
            const $select = $(this);
            const $wrapper = $select.closest('.attribute-wrapper');
            const isRequired = $wrapper.data('is-required');

            const $option = $select.find('option:selected');
            const attrId = $option.data('attribute-id');
            const valueId = $option.data('value-id');
            const selectedValue = $option.val();

            // If user selected the empty "-- Select --" option
            if (selectedValue === '') {
                if (isRequired) {
                    // Revert to first valid value
                    const $firstReal = $select.find('option[data-value-id]').first();
                    $firstReal.prop('selected', true);

                    handleAttributeConditions(attrId, $firstReal.data('value-id'));
                    renderCompositeFromCurrentSelection();
                    calculateTotalPrice();
                } else {
                    // Optional → treat as no selection
                    handleAttributeConditions(attrId, null);
                    renderCompositeFromCurrentSelection();
                    calculateTotalPrice();
                }
                return;
            }

            // If a valid value was selected
            handleAttributeConditions(attrId, valueId);
            renderCompositeFromCurrentSelection();
            calculateTotalPrice();
        });


        $('#quantityInput').on('input', calculateTotalPrice);

        $(document).on('change', '.group-toggle', function () {
            const target = $(this).data('target');
            const isChecked = $(this).is(':checked');
            $(target).toggleClass('d-none', !isChecked);

            if (isChecked) {
                // Find all default buttons inside this group
                $(target).find('[data-original-default="true"]').each(function () {
                    const $btn = $(this);
                    const $input = $btn.find('input[type="radio"], input[type="checkbox"]');

                    // Deselect siblings (for radio-like buttons)
                    const name = $input.attr('name');
                    if ($input.attr('type') === 'radio') {
                        $(`input[name="${name}"]`).prop('checked', false).closest('.btn').removeClass('active').attr('data-selected', 'false');
                    }

                    // Set checked and active
                    $input.prop('checked', true);
                    $btn.addClass('active').attr('data-selected', 'true');
                });
                calculateTotalPrice();
            } else {
                // Optionally reset selections when unchecked
                $(target).find('input[type="radio"], input[type="checkbox"]').prop('checked', false);
                $(target).find('.btn').removeClass('active').attr('data-selected', 'false');
            }
        });


        $('.help-circle').on('click', function () {
            const label = $(this).data('label');
            const helpContent = {
                'Quantity': 'Specify the number of booklets you want to print. Enter a value between 1 and 1000.',
                'Colour Printing': 'Choose between full-color printing (Colors) or black-and-white (Grayscale) for your booklet.',
                'Orientation': 'Select the page orientation: Portrait (vertical) or Landscape (horizontal).',
                'Size': 'Choose the booklet size from standard options or select Custom Size for specific dimensions.',
                'Paper Type': 'Choose the type of paper finish, such as Silk, Gloss, Uncoated, or Recycled Natural.',
                'Paper Weight': 'Select the paper thickness, measured in grams per square meter (gsm). Higher gsm indicates thicker paper.',
                'Binding': 'Choose the binding method: Staple, Perfect (PUR), or Wiro for securing the booklet pages.',
                'Pages': 'Adjust the number of pages for your booklet, ranging from 32 to 840 pages.'
            };

            $('#helpModalLabel').text(`${label} Help`);
            $('#helpModalBody').text(helpContent[label] || 'No help content available.');
        });

        const slider = document.getElementById('pageSlider');
        const valueDisplay = document.getElementById('pageValue');
        const decrementBtn = valueDisplay.previousElementSibling;
        const incrementBtn = valueDisplay.nextElementSibling;

        function updateSliderFill(sliderElement) {
            const percent = ((sliderElement.value - sliderElement.min) / (sliderElement.max - sliderElement.min)) * 100;
            sliderElement.style.setProperty('--value', `${percent}%`);
        }


        slider.addEventListener('input', () => {
            valueDisplay.textContent = slider.value;
            updateSliderFill();
            debouncedCalculateTotalPrice();
        });

        decrementBtn?.addEventListener('click', () => {
            let val = +slider.value;
            if (val > 32) {
                slider.value = val - 1;
                valueDisplay.textContent = slider.value;
                updateSliderFill(slider); // <-- updated here
                debouncedCalculateTotalPrice();
            }
        });

        incrementBtn?.addEventListener('click', () => {
            let val = +slider.value;
            if (val < 840) {
                slider.value = val + 1;
                valueDisplay.textContent = slider.value;
                updateSliderFill(slider); // <-- updated here
                debouncedCalculateTotalPrice();
            }
        });


        $(document).on('input', '#pageSlider', function () {
            const val = $(this).val();
            $(this).next('.range-value').find('#page-value').text(val);
            updateSliderFill(this); // <-- new addition
            debouncedCalculateTotalPrice();
        });

        $(document).on('input', '.composite-slider', function () {
            const val = $(this).val();
            $(this).next('.range-value').find('.composite-value').text(val);
            updateSliderFill(this); // <-- new addition
            debouncedCalculateTotalPrice();
        });

        $(document).on('click', '.increase', function () {
            const $slider = $(this).closest('.range-value').prev('input.composite-slider');
            let current = +$slider.val();
            if (current < 840) {
                $slider.val(current + 1).trigger('input');
                updateSliderFill($slider[0]); // <-- new
            }
        });

        $(document).on('click', '.decrease', function () {
            const $slider = $(this).closest('.range-value').prev('input.composite-slider');
            let current = +$slider.val();
            if (current > 32) {
                $slider.val(current - 1).trigger('input');
                updateSliderFill($slider[0]); // <-- new
            }
        });




        updateSliderFill();

        calculateTotalPrice();
        renderCompositeFromCurrentSelection();

        $('.attribute-wrapper .active').each(function () {
            const attrId = $(this).data('attribute-id');
            const valueId = $(this).data('value-id');
            handleAttributeConditions(attrId, valueId);
        });

        $('select.custom-select').each(function () {
            const selected = $(this).find('option:selected');
            const attrId = selected.data('attribute-id');
            const valueId = selected.data('value-id');
            handleAttributeConditions(attrId, valueId);
        });
    });

    function calculatedAttributeRow() {
        let colSum = 0;

        // Select only visible attribute blocks
        const $attributeBlocks = $('.row .attribute-wrapper:visible');

        // First, remove any existing hr-wrapper divs
        $('.hr-wrapper').remove();

        $attributeBlocks.each(function (index) {
            const $col = $(this);
            const colClass = $col.attr('class');

            // Extract the number after col-md-
            const match = colClass.match(/col-md-(\d+)/);
            const colWidth = match ? parseInt(match[1]) : 12;

            colSum += colWidth;

            if (colSum >= 12) {
                // Only insert <hr> if it's not the last one
                if (index !== $attributeBlocks.length - 1) {
                    $col.after(`
                    <div class="col-md-12 hr-wrapper" data-hr-for-index="${index}">
                        <hr style="height: 0.8px; opacity: 0.25; color: inherit; border: 0;">
                    </div>
                `);
                }
                colSum = 0;
            }
        });
    }


    function handleAttributeConditions(selectedAttrId, selectedValueId) {
        $('.attribute-condition-note').remove();

        attributeConditions.forEach(condition => {
            if (condition.action !== 'hide') return;
            if (+condition.parent_attribute_id !== +selectedAttrId) return;

            const parentAttrId = +condition.parent_attribute_id;
            const parentValueId = +condition.parent_value_id;
            const affectedAttrId = +condition.affected_attribute_id;

            const $parentWrapper = $(`[data-attribute-id="${parentAttrId}"]`);
            const $affectedWrapper = $(`[data-attribute-id="${affectedAttrId}"]`);

            const shouldShow = +selectedValueId === parentValueId;

            if (shouldShow) {
                $affectedWrapper.removeClass('disabled');
                $affectedWrapper.show();
                calculatedAttributeRow();
            } else {


                $affectedWrapper.addClass('disabled');
                $affectedWrapper.hide();
                calculatedAttributeRow();

                const parentValueLabel =
                    $parentWrapper.find(`[data-value-id="${parentValueId}"]`).text().trim() ||
                    $parentWrapper.find(`option[data-value-id="${parentValueId}"]`).text().trim();
                $affectedWrapper.append(`
        <p class="attribute-condition-note text-danger mt-2">
            Only available for ${parentValueLabel}.
        </p>
    `);
            }

        });
    }


    function applyInitialHideConditions() {
        $('.attribute-wrapper').removeClass('d-none');
        $('.attribute-condition-note').remove();
        $('.attribute-values').show();
        $('.attribute-values [data-value-id]').show(); // ensure all values shown initially

        attributeConditions.forEach(condition => {
            if (condition.action === 'hide') {
                const parentAttrId = +condition.parent_attribute_id;
                const parentValueId = +condition.parent_value_id;
                const affectedAttrId = +condition.affected_attribute_id;

                const $parentWrapper = $(`[data-attribute-id="${parentAttrId}"]`);
                const $affectedWrapper = $(`[data-attribute-id="${affectedAttrId}"]`);

                // Get selected value ID from parent
                let selectedValueId = null;

                const $active = $parentWrapper.find('.attribute-values .active[data-value-id]');
                if ($active.length) {
                    selectedValueId = +$active.data('value-id');
                } else {
                    const $select = $parentWrapper.find('select');
                    if ($select.length && $select.val()) {
                        selectedValueId = +$select.find('option:selected').data('value-id');
                    }
                }

                const shouldShow = selectedValueId === parentValueId;

                if (shouldShow) {
                    $affectedWrapper.removeClass('disabled');
                    $affectedWrapper.show();
                    calculatedAttributeRow();
                } else {
                    $affectedWrapper.addClass('disabled');
                    // $affectedWrapper.find('.attribute-values').hide();
                    $affectedWrapper.hide();
                    calculatedAttributeRow();

                    const parentValueLabel =
                        $parentWrapper.find(`[data-value-id="${parentValueId}"]`).text().trim() ||
                        $parentWrapper.find(`option[data-value-id="${parentValueId}"]`).text().trim();
                    $affectedWrapper.append(`
                            <p class="attribute-condition-note text-danger mt-2">
                                Only available for ${parentValueLabel}.
                            </p>
                        `);
                }
            }

            if (condition.action === 'change_option' || condition.action === 'change_options') {
                const affectedAttrId = +condition.affected_attribute_id;
                const $affected = $(`[data-attribute-id="${affectedAttrId}"]`);
                const $valuesPart = $affected.find('.attribute-values');
                const $label = $affected.find('label').first();
                const attributeLabel = $label.clone().children().remove().end().text().trim();

                // Hide values and disable inputs
                $valuesPart.hide().find('input, select, button').prop('disabled', true);

                // Only insert checkbox if not already there
                if (!$affected.find('.change-option-checkbox').length) {
                    $label.hide(); // Hide original label

                    const checkboxHTML = `
            <div class="form-check d-flex mb-2">
                <input class="form-check-input change-option-checkbox" type="checkbox" id="toggle-${affectedAttrId}" data-affected-id="${affectedAttrId}" style="border: 1px solid #212529">
                <label class="form-label" for="toggle-${affectedAttrId}" style="margin-bottom:0px">
                    ${attributeLabel}
                </label>
            </div>
        `;

                    $label.before(checkboxHTML);
                }
            }

        });
    }


    $(document).on('change', '.change-option-checkbox', function () {
        const affectedAttrId = $(this).data('affected-id');
        const $wrapper = $(`[data-attribute-id="${affectedAttrId}"]`);
        const $values = $wrapper.find('.attribute-values');

        if ($(this).is(':checked')) {
            $values.slideDown().find('input, select, button').prop('disabled', false);
        } else {
            $values.slideUp().find('input, select, button').prop('disabled', true);
        }
    });


    $(document).ready(function () {
        applyInitialHideConditions();
        calculateTotalPrice();
        forceSliderRedraw();
        calculatedAttributeRow();


        $('.estimate-option').on('click', function () {
            $('.estimate-option').removeClass('active');
            $('.estimate-option .ast-active').removeClass('ast-active');

            $('.detail-section').addClass('d-none');
            $('.title').addClass('d-none');

            $(this).addClass('active');
            $(this).find('div').first().addClass('ast-active');

            $(this).find('.detail-section').removeClass('d-none');
            $(this).find('.title').removeClass('d-none');
        });

        // Show details for the initially active card (based on is_default)
        const $initial = $('.estimate-option.active');
        $initial.find('.detail-section').removeClass('d-none');
        $initial.find('.title').removeClass('d-none');

        $('.selectable-proof-option').on('click', function () {
            const $this = $(this);
            // If already active → unselect
            if ($this.hasClass('active')) {
                $this.removeClass('active');
            } else {
                // Otherwise, make it active and unselect others
                $('.selectable-proof-option').removeClass('active');
                $this.addClass('active');
            }

            calculateTotalPrice(); // always recalculate
        });

    });


    $('#addToCartBtn').on('click', function () {
        let isValid = true;
        let missingFields = [];

        $('.attribute-wrapper').each(function () {
            const $wrapper = $(this);
            const isRequired = $wrapper.data('is-required');

            if (isRequired) {
                const hasActive = $wrapper.find('.attr-select.active, .print-color.active, .choose-binding.active').length > 0;
                const hasSelect = $wrapper.find('select.custom-select option:selected').filter(function () {
                    return $(this).val() !== '';
                }).length > 0;

                if (!hasActive && !hasSelect) {
                    isValid = false;

                    const label = $wrapper.find('label').clone().children().remove().end().text().trim();
                    missingFields.push(label || 'Required attribute');
                }
            }
        });

        if (!isValid) {
            alert(`Please select the following required options:\n- ${missingFields.join('\n- ')}`);
            return;
        }

        const route = $(this).data('route');
        // return

        const quantity = parseInt($('#quantityInput').val()) || 1;
        let pages = parseInt($('#pageSlider').val()) || 32;
        let compositePages = {};

        const selectedAttributes = {};

        $('.attribute-wrapper .active').each(function () {
            const attrId = $(this).data('attribute-id');
            const valueId = $(this).data('value-id');
            if (attrId && valueId) selectedAttributes[attrId] = valueId;
        });

        $('select.custom-select').each(function () {
            const selected = $(this).find('option:selected');
            const attrId = selected.data('attribute-id');
            const valueId = selected.data('value-id');
            if (attrId && valueId) selectedAttributes[attrId] = valueId;
        });

        // Add select_area attribute values
        $('.attribute-wrapper[data-attribute-type="select_area"]').each(function () {
            const $wrapper = $(this);
            const attrId = $wrapper.data('attribute-id');

            const length = parseFloat($wrapper.find('input[name^="attributes["][name$="[length]"]').val()) || 0;
            const width = parseFloat($wrapper.find('input[name^="attributes["][name$="[width]"]').val()) || 0;
            const area = parseFloat($wrapper.find('input[name^="attributes["][name$="[area]"]').val()) || (length * width);
            const unit = $wrapper.find('input.area-input').first().data('area-unit') || ''; // Grab from first area input

            if (length > 0 && width > 0) {
                selectedAttributes[attrId] = {
                    type: 'select_area',
                    length: length,
                    width: width,
                    area: area,
                    unit: unit    // 👈 Add this
                };
            }
        });



        // Handle composite pages
        if ($('.composite-slider').length > 0) {
            let compositeValueId = null;

            $('.attribute-wrapper .active').each(function () {
                const valueId = $(this).data('value-id');
                if (compositeMap[valueId]) {
                    compositeValueId = valueId;
                }
            });

            $('select.custom-select').each(function () {
                const selected = $(this).find('option:selected');
                const valueId = selected.data('value-id');
                if (compositeMap[valueId]) {
                    compositeValueId = valueId;
                }
            });

            const valueObj = compositeDraggerValues.find(val => val.id === compositeValueId);
            const components = valueObj?.components || [];

            let pageBreakdown = {};
            $('.composite-slider').each(function () {
                const index = parseInt($(this).data('index'));
                const label = components[index - 1] || `Part ${index}`;
                const value = parseInt($(this).val()) || 0;
                pageBreakdown[label] = value;
            });

            compositePages[compositeValueId] = pageBreakdown;
            pages = 0; // composite overrides
        }

        // Get selected delivery option
        const selectedDelivery = $('.estimate-option.active');
        const deliveryDate = selectedDelivery.data('date') || null;
        const deliveryPrice = parseFloat(selectedDelivery.data('price')) || 0;
        const deliveryId = parseInt(selectedDelivery.data('id')) || null;

        // Get selected proof reading option
        const proofOption = $('.selectable-proof-option.active');
        const proofType = proofOption.data('value') || null;
        const proofPrice = parseFloat(proofOption.data('price')) || 0;
        const proofId = parseInt(proofOption.data('id')) || null;

        const subcategory_id = $(this).data('subcategory-id');

        const selectedCard = $('.estimate-card.active'); // or use `.selected`, however your logic marks it

        var finalPriceText = 0;

        if (selectedCard.length === 0) {
            finalPriceText = $('.final-price').text();
        } else {
            finalPriceText = selectedCard.find('.final-price').text(); // e.g., "£27.50"
        }

        const totalPrice = parseFloat(finalPriceText.replace('£', '')) || 0;
        // console.log("selectedAttributes", selectedAttributes);
        // return;
        // Send AJAX to backend
        $.ajax({
            url: route,
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>',
                quantity,
                pages,
                subcategory_id,
                totalPrice: totalPrice,
                attributes: selectedAttributes,
                composite_pages: compositePages,
                delivery: {
                    id: deliveryId,
                    date: deliveryDate,
                    price: deliveryPrice,
                },
                proof: {
                    id: proofId,
                    proof_type: proofType,
                    price: proofPrice,
                }
            },
            success: function (response) {
                if (response.success && response.redirect_url) {
                    window.location.href = response.redirect_url;
                } else {
                    alert('Something went wrong while adding to cart.');
                }
            },
            error: function (xhr) {
                alert('Error occurred while adding to cart.');
                console.error(xhr.responseText);
            }
        });
    });

</script><?php /**PATH D:\web-mingo-project\new\resources\views/front/calculator.blade.php ENDPATH**/ ?>