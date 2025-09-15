<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="<?php echo e(Route('dashboard.index')); ?>">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="list-divider"></li>

                <li class="nav-small-cap"><span class="hide-menu">Main</span></li>

                <!-- Profile & Settings (Always Visible) -->
                <li class="sidebar-item has-arrow" data-section="profile-settings">
                    <a class="sidebar-link" href="javascript:void(0)">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu">Profile & Settings</span>
                    </a>
                    <ul class="collapse first-level base-level-line">
                        <li class="sidebar-item"><a href="<?php echo e(Route('dashboard.profile')); ?>" class="sidebar-link"><span
                                    class="hide-menu">Profile</span></a></li>
                        <li class="sidebar-item"><a href="<?php echo e(Route('dashboard.bank')); ?>" class="sidebar-link"><span
                                    class="hide-menu">Bank Account</span></a></li>
                        <li class="sidebar-item"><a href="<?php echo e(Route('dashboard.notifications')); ?>"
                                class="sidebar-link"><span class="hide-menu">Notifications</span></a></li>
                    </ul>
                </li>

                <!-- Buyer Section -->
                <div id="buyer-section" style="display:none;">
                    <li class="sidebar-item has-arrow">
                        <a class="sidebar-link" href="javascript:void(0)">
                            <i data-feather="grid" class="feather-icon"></i>
                            <span class="hide-menu">Orders & Invoice</span>
                        </a>
                        <ul class="collapse first-level base-level-line">
                            <li class="sidebar-item"><a href="<?php echo e(route('dashboard.buyer-orders')); ?>"
                                    class="sidebar-link">Orders</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                            href="<?php echo e(Route('dashboard.wallet')); ?>" aria-expanded="false"><i data-feather="sidebar"
                                class="feather-icon"></i><span class="hide-menu">Wallet
                            </span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                            href="<?php echo e(Route('dashboard.enquiries')); ?>" aria-expanded="false"><i data-feather="sidebar"
                                class="feather-icon"></i><span class="hide-menu">Business Enqurie
                            </span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                            href="<?php echo e(Route('dashboard.wishlist')); ?>" aria-expanded="false"><i data-feather="sidebar"
                                class="feather-icon"></i><span class="hide-menu">Wishlist
                            </span></a>
                    </li>
                </div>
                <!-- Seller Section -->
                <div id="seller-section" style="display:none;">
                    <li class="sidebar-item has-arrow">
                        <a class="sidebar-link" href="javascript:void(0)">
                            <i data-feather="grid" class="feather-icon"></i>
                            <span class="hide-menu">Orders & Invoice</span>
                        </a>
                        <ul class="collapse first-level base-level-line">
                            <li class="sidebar-item"><a href="<?php echo e(route('dashboard.seller-orders')); ?>"
                                    class="sidebar-link">Orders</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                            href="<?php echo e(Route('dashboard.wallet')); ?>" aria-expanded="false"><i data-feather="sidebar"
                                class="feather-icon"></i><span class="hide-menu">Wallet
                            </span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                            href="<?php echo e(Route('dashboard.enquiries')); ?>" aria-expanded="false"><i data-feather="sidebar"
                                class="feather-icon"></i><span class="hide-menu">Business Enquries
                            </span></a>
                    </li>
                    <li class="sidebar-item has-arrow">
                        <a class="sidebar-link" href="javascript:void(0)">
                            <i data-feather="file-text" class="feather-icon"></i>
                            <span class="hide-menu">Subscriptions & Plan</span>
                        </a>
                        <ul class="collapse first-level base-level-line">
                            <li class="sidebar-item"><a href="<?php echo e(Route('dashboard.subscriptions')); ?>"
                                    class="sidebar-link">Subscriptions</a></li>
                            <li class="sidebar-item"><a href="<?php echo e(Route('dashboard.subscription-plan')); ?>"
                                    class="sidebar-link">Plan</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link"
                            href="<?php echo e(Route('dashboard.listing')); ?>" aria-expanded="false"><i data-feather="sidebar"
                                class="feather-icon"></i><span class="hide-menu">Listing & Products
                            </span></a>
                    </li>
                    <li class="sidebar-item has-arrow">
                        <a class="sidebar-link" href="javascript:void(0)">
                            <i data-feather="grid" class="feather-icon"></i>
                            <span class="hide-menu">Reports & Analytics</span>
                        </a>
                        <ul class="collapse first-level base-level-line">
                            <li class="sidebar-item"><a href="<?php echo e(Route('dashboard.reports')); ?>"
                                    class="sidebar-link">Reports</a></li>
                            <li class="sidebar-item"><a href="<?php echo e(Route('dashboard.analytics')); ?>"
                                    class="sidebar-link">Analytics</a></li>
                        </ul>
                    </li>
                </div>

                <!-- Help & Support (Always Visible) -->
                <li class="sidebar-item has-arrow">
                    <a class="sidebar-link" href="javascript:void(0)">
                        <i data-feather="file-text" class="feather-icon"></i>
                        <span class="hide-menu">Help & Support</span>
                    </a>
                    <ul class="collapse first-level base-level-line">
                        <li class="sidebar-item"><a href="<?php echo e(Route('dashboard.faq')); ?>" class="sidebar-link">FAQ</a>
                        </li>
                        <li class="sidebar-item"><a href="<?php echo e(Route('dashboard.raise')); ?>" class="sidebar-link">Raise
                                a Request</a></li>
                        <li class="sidebar-item"><a href="<?php echo e(Route('dashboard.contact')); ?>" class="sidebar-link">Contact
                                Us</a></li>
                    </ul>
                </li>

                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="<?php echo e(Route('account-logout')); ?>"><i
                            data-feather="log-out" class="feather-icon"></i>Logout</a></li>

            </ul>
        </nav>
    </div>
</aside>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let activeTab = localStorage.getItem("activeDashboardTab") || "buyer";

            if (activeTab === "buyer") {
                document.getElementById("buyer-section").style.display = "block";
            } else {
                document.getElementById("seller-section").style.display = "block";
            }
        });
    </script>
<?php $__env->stopPush(); ?><?php /**PATH D:\web-mingo-project\flippingo_admin\resources\views/user/sidebar.blade.php ENDPATH**/ ?>