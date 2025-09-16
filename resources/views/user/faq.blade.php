@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'FAQ' }}
@endsection


@section('content')

    @include('user.sidebar')

    <div class="page-wrapper">

        <div class="faq-page container my-5">
            <div class="row">
                <!-- Left Sidebar (Categories) -->
                <div class="col-md-3 faq-sidebar">
                    <h5 class="faq-title">Categories</h5>
                    <ul class="faq-category-list">
                        @foreach($categories as $key => $category)
                            <li class="{{ $key === 0 ? 'active' : '' }}" data-category="{{ $category->slug }}">
                                {{ $category->name }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Right Content (FAQs) -->
                <div class="col-md-9 faq-content">
                    <!-- General -->
                    @foreach($categories as $key => $category)
                        <div class="faq-category-content {{ $key === 0 ? 'active' : '' }}" id="{{ $category->slug }}">
                            <h4 class="faq-heading">{{ $category->name }} FAQs</h4>
                            <div class="faq-accordion">
                                @forelse($category->faqs as $faq)
                                    <div class="faq-item" data-type="{{ $faq->type }}">
                                        <div class="faq-question">{{ $faq->question }}</div>
                                        <div class="faq-answer">{{ $faq->answer }}</div>
                                    </div>
                                @empty
                                    <p>No FAQs available for this category.</p>
                                @endforelse
                            </div>
                        </div>

                    @endforeach

                    <!-- <div class="faq-category-content active" id="general">
                                    <h4 class="faq-heading">General FAQs</h4>
                                    <div class="faq-accordion">
                                        <div class="faq-item">
                                            <div class="faq-question">What is this platform about?</div>
                                            <div class="faq-answer">This platform allows users to manage wallets, payments, and
                                                transactions easily.</div>
                                        </div>
                                        <div class="faq-item">
                                            <div class="faq-question">How do I register?</div>
                                            <div class="faq-answer">You can register by clicking on the Sign-Up button and filling the
                                                required details.</div>
                                        </div>
                                    </div>
                                </div> -->

                    <!-- Payments -->
                    <!-- <div class="faq-category-content" id="payments">
                                    <h4 class="faq-heading">Payments FAQs</h4>
                                    <div class="faq-accordion">
                                        <div class="faq-item">
                                            <div class="faq-question">How do I add funds?</div>
                                            <div class="faq-answer">You can add funds via UPI, Bank Transfer, or Debit/Credit Card.
                                            </div>
                                        </div>
                                        <div class="faq-item">
                                            <div class="faq-question">Are there any transaction charges?</div>
                                            <div class="faq-answer">No hidden charges, only applicable bank/UPI fees are applied.</div>
                                        </div>
                                    </div>
                                </div> -->

                    <!-- Wallet -->
                    <!-- <div class="faq-category-content" id="wallet">
                                    <h4 class="faq-heading">Wallet FAQs</h4>
                                    <div class="faq-accordion">
                                        <div class="faq-item">
                                            <div class="faq-question">Can I withdraw money?</div>
                                            <div class="faq-answer">Yes, withdrawals can be made to your verified bank account.</div>
                                        </div>
                                        <div class="faq-item">
                                            <div class="faq-question">Is there a wallet balance limit?</div>
                                            <div class="faq-answer">Currently, there is no upper limit on wallet balance.</div>
                                        </div>
                                    </div>
                                </div> -->

                    <!-- Security -->
                    <!-- <div class="faq-category-content" id="security">
                                    <h4 class="faq-heading">Security FAQs</h4>
                                    <div class="faq-accordion">
                                        <div class="faq-item">
                                            <div class="faq-question">Is my data safe?</div>
                                            <div class="faq-answer">Yes, we use industry-standard encryption for all transactions.</div>
                                        </div>
                                        <div class="faq-item">
                                            <div class="faq-question">Can someone hack my wallet?</div>
                                            <div class="faq-answer">With 2FA and encryption, your wallet is secured from unauthorized
                                                access.</div>
                                        </div>
                                    </div>
                                </div> -->

                    <!-- Account -->
                    <!-- <div class="faq-category-content" id="account">
                                    <h4 class="faq-heading">Account FAQs</h4>
                                    <div class="faq-accordion">
                                        <div class="faq-item">
                                            <div class="faq-question">How can I update my profile?</div>
                                            <div class="faq-answer">Go to Settings → Profile section to update your details.</div>
                                        </div>
                                        <div class="faq-item">
                                            <div class="faq-question">Can I delete my account?</div>
                                            <div class="faq-answer">Yes, you can request account deletion from the Support section.
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                </div>
            </div>
        </div>


    </div>

@endsection

@push('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let activeTab = localStorage.getItem("activeDashboardTab") || "buyer"; // buyer or seller

            // Map tab to FAQ type string
            let faqType = activeTab === "buyer" ? "Buyers FAQ" : "Seller FAQ";

            // Filter FAQ items
            document.querySelectorAll(".faq-item").forEach(faq => {
                if (faq.dataset.type !== faqType) {
                    faq.style.display = "none";
                } else {
                    faq.style.display = "block";
                }
            });

            // Accordion toggle for visible items
            document.querySelectorAll(".faq-question").forEach(item => {
                item.addEventListener("click", function () {
                    let parent = this.parentElement;
                    let container = parent.parentElement;

                    container.querySelectorAll(".faq-item").forEach(faq => faq.classList.remove("active"));

                    parent.classList.add("active");
                });
            });

            // Category switching (if you want)
            document.querySelectorAll(".faq-category-list li").forEach(cat => {
                cat.addEventListener("click", function () {
                    // remove old active
                    document.querySelectorAll(".faq-category-list li").forEach(c => c.classList.remove("active"));
                    document.querySelectorAll(".faq-category-content").forEach(content => content.classList.remove("active"));

                    // add new active
                    this.classList.add("active");
                    document.getElementById(this.dataset.category).classList.add("active");
                });
            });
        });
    </script>


@endpush