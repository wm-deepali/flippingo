<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="index.html"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>
                
                <li class="nav-small-cap"><span class="hide-menu">Main</span></li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                        aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                            class="hide-menu">Profile & Settings </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="{{ Route('dashboard.profile') }}" class="sidebar-link"><span
                                    class="hide-menu"> Profile
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ Route('dashboard.bank') }}" class="sidebar-link"><span
                                    class="hide-menu">Bank Account
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ Route('dashboard.notifications') }}" class="sidebar-link"><span
                                    class="hide-menu"> Notifications
                                </span></a>
                        </li>
                    </ul>
                </li>

                @if($activeTab === 'buyer')
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                class="hide-menu">Orders & Invoice </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="{{ Route('dashboard.orders') }}" class="sidebar-link"><span
                                        class="hide-menu">Orders
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{ Route('dashboard.invoices') }}" class="sidebar-link"><span
                                        class="hide-menu">Invoice
                                    </span></a>
                        
                        </ul>
                    </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ Route('dashboard.wallet') }}"
                            aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span
                                class="hide-menu">Wallet
                            </span></a>
                    </li>
                      <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ Route('dashboard.enquiries') }}"
                            aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span
                                class="hide-menu">Business Enqurie
                            </span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ Route('dashboard.wishlist') }}"
                            aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span
                                class="hide-menu">Wishlist
                            </span></a>
                    </li>
                @endif

                 @if($activeTab === 'seller')
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                class="hide-menu">Orders & Invoice </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="{{ Route('dashboard.orders') }}" class="sidebar-link"><span
                                        class="hide-menu">Orders
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{ Route('dashboard.invoices') }}" class="sidebar-link"><span
                                        class="hide-menu">Invoice
                                    </span></a>
                        
                        </ul>
                    </li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ Route('dashboard.wallet') }}"
                            aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span
                                class="hide-menu">Wallet
                            </span></a>
                    </li>
                      <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ Route('dashboard.enquiries') }}"
                            aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span
                                class="hide-menu">Business Enqurie
                            </span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ Route('dashboard.subscriptions') }}"
                            aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span
                                class="hide-menu">Subscriptions
                            </span></a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ Route('dashboard.listing') }}"
                            aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span
                                class="hide-menu">Listing & Products
                            </span></a>
                    </li>
                
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                            aria-expanded="false"><i data-feather="grid" class="feather-icon"></i><span
                                class="hide-menu">Reports & Analytics </span></a>
                        <ul aria-expanded="false" class="collapse  first-level base-level-line">
                            <li class="sidebar-item"><a href="{{ Route('dashboard.reports') }}" class="sidebar-link"><span
                                        class="hide-menu">Reports
                                    </span></a>
                            </li>
                            <li class="sidebar-item"><a href="{{ Route('dashboard.analytics') }}" class="sidebar-link"><span
                                        class="hide-menu">Analytics
                                    </span></a>
                        
                        </ul>
                    </li>
                @endif

                <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                        aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span
                            class="hide-menu">Help & Support </span></a>
                    <ul aria-expanded="false" class="collapse  first-level base-level-line">
                        <li class="sidebar-item"><a href="{{ Route('dashboard.faq') }}" class="sidebar-link"><span
                                    class="hide-menu"> FAQ
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ Route('dashboard.raise') }}" class="sidebar-link"><span
                                    class="hide-menu">Raise a Request
                                </span></a>
                        </li>
                        <li class="sidebar-item"><a href="{{ Route('dashboard.contact') }}" class="sidebar-link"><span
                                    class="hide-menu"> Contact Us
                                </span></a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ Route('account-logout') }}"
                        aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                            class="hide-menu">Logout</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>