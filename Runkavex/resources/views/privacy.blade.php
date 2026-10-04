@extends('layouts.sub')
@section('content')

<section class="bg-body-bg py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <h1 class="font-serif text-3xl md:text-4xl font-bold text-body-text">Privacy <span class="text-primary">Policy</span></h1>
        <div class="flex items-center justify-center gap-2 mt-3 text-sm text-body-muted">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-primary">AML Policy</span>
        </div>
    </div>
</section>

<section class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6">
        <div class="bg-body-bg rounded-xl border border-body-border p-6 md:p-10">
            <div class="flex gap-3 mb-6">
                <a href="{{ url('/terms') }}" class="text-sm font-medium bg-body-bg text-body-muted px-3 py-1 rounded-full border border-body-border hover:text-primary transition">Risk Warning</a>
                <a href="{{ url('/privacy') }}" class="text-sm font-medium bg-primary-subtle text-primary px-3 py-1 rounded-full hover:bg-primary hover:text-white transition">Privacy Policy</a>
            </div>

            <article class="prose prose-sm max-w-none text-body-muted leading-relaxed space-y-6">
                @if(!empty($legal))
                    {!! $legal !!}
                @else
                <h3 class="text-xl font-bold text-body-text">ANTI-MONEY LAUNDERING (AML) POLICY</h3>
                <p>Runkavex Capital is committed to preventing the use of its products and services for money laundering, terrorist financing and any other illegal or fraudulent activity. We take a zero-tolerance approach and operate a robust, risk-based Anti-Money Laundering (AML) and Know Your Customer (KYC) framework in line with international standards and applicable law.</p>

                <h4 class="text-lg font-semibold text-body-text">Our obligations</h4>
                <p>We are required to verify the identity of every customer before any activity takes place on their account. This includes collecting proof of identity, proof of address and, where appropriate, information about the source of funds and the purpose of the business relationship.</p>

                <h4 class="text-lg font-semibold text-body-text">Customer due diligence (CDD)</h4>
                <p>We carry out identity verification on all new customers and apply enhanced due diligence (EDD) where higher-risk factors are identified. Documents provided are validated, and all customers are screened against relevant sanctions and watch lists.</p>

                <h4 class="text-lg font-semibold text-body-text">Monitoring and reporting</h4>
                <p>Transactions and account activity are monitored on an ongoing basis for unusual or suspicious patterns. Any activity that gives rise to reasonable suspicion is reported to the relevant authorities, in accordance with our legal obligations, and the account may be restricted or closed pending investigation.</p>

                <h4 class="text-lg font-semibold text-body-text">Your cooperation</h4>
                <p>By using our services, you agree to provide accurate and complete information and to cooperate with any reasonable verification or due diligence request made by us. We may refuse or terminate a business relationship where we are unable to complete the required checks to our satisfaction.</p>

                <h4 class="text-lg font-semibold text-body-text">Record keeping</h4>
                <p>Copies of all identification documents, transaction records and due diligence information are stored securely for the period required by law. Access to this information is restricted to authorized personnel on a need-to-know basis and is never shared other than as required by law.</p>
                @endif
            </article>
        </div>
    </div>
</section>

@endsection
