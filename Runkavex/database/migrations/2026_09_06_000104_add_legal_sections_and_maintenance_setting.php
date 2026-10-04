<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $termsDefault = <<<'HTML'
<h3 class="text-xl font-bold text-body-text">RISK WARNING</h3>
<p>Trading foreign exchange on margin carries a high level of risk, and may not be suitable for all investors. Before deciding to trade foreign exchange, you should carefully consider your investment objectives, level of experience, and risk appetite. There is a possibility that you may sustain a loss of some or all of your investment and therefore you should not invest money that you cannot afford to lose. You should be aware of all the risks associated with foreign exchange trading, and seek advice from an independent financial advisor if you have any doubts.</p>

<h4 class="text-lg font-semibold text-body-text">Risks of investing in CFDs</h4>
<p>CFDs, especially when highly leveraged (the higher the leverage of the CFD, the more risky it becomes), carry a very high level of risk. They are not standardized products. Different CFD providers have their own terms, conditions and costs. Therefore, generally, they are not suitable for most retail investors.</p>

<h4 class="text-lg font-semibold text-body-text">Liquidity risk</h4>
<p>Liquidity risk affects your ability to trade. It is the risk that your CFD or asset cannot be traded at the time you want to trade (to prevent a loss, or to make a profit).</p>

<h4 class="text-lg font-semibold text-body-text">Execution risk</h4>
<p>Execution risk is associated with the fact that trades may not take place immediately. For example, there might be a time lag between the moment you place your order and the moment it is executed.</p>

<h4 class="text-lg font-semibold text-body-text">Internet Trading Risks</h4>
<p>There are risks associated with utilizing an Internet-based deal execution trading system including, but not limited to, the failure of hardware, software, and Internet connection. Since Runkavex Capital does not control signal power, its reception or routing via Internet, configuration of your equipment or reliability of its connection, we cannot be responsible for communication failures, distortions or delays when trading via the Internet.</p>

<h4 class="text-lg font-semibold text-body-text">Acknowledgement</h4>
<p>The client acknowledges and declares that he has read, understood and thus accepts without any reservation the following:</p>

<ul class="list-disc list-inside space-y-3 text-body-muted">
    <li>The value of the Financial Instrument (including currency pair, CFDs, or any other derivative product) may decrease and the client may receive less money than originally invested or the value of the Financial Instruments may present high fluctuations.</li>
    <li>Information on past performance of a Financial Instrument does not guarantee the present and/or future performance; the use of historic data does not constitute a binding or safe forecast as to the corresponding future return of the Financial Instruments to which such data refers.</li>
    <li>Some Financial Instruments may not become immediately liquid due to various reasons such as reduced demand, and the Company may not be in a position to sell them or easily obtain information on the value of such Financial Instruments or the extent of any related or inherent risk concerning such Financial Instruments.</li>
    <li>When a Financial Instrument is negotiated in a currency other than the currency of the client's country of residence, any changes in an exchange rate may have a negative effect on the Financial Instruments' value, price and performance.</li>
    <li>A Financial Instrument in foreign markets may entail risks different than the usual risks in the markets at the client's country of residence. The prospect of profit or loss from transactions in foreign markets is also influenced by the exchange rate fluctuations.</li>
</ul>
HTML;

        $privacyDefault = <<<'HTML'
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
HTML;

        $riskDefault = $termsDefault;

        $securityDefault = <<<'HTML'
<h3 class="text-xl font-bold text-body-text">HOW WE PROTECT YOUR ACCOUNT</h3>
<p>Security is a core part of our platform, not an afterthought. We use industry-standard security practices to protect your data and funds.</p>

<h4 class="text-lg font-semibold text-body-text">Encryption &amp; transport security</h4>
<p>All connections to our platform are protected with SSL/TLS encryption, ensuring your data is secure in transit.</p>

<h4 class="text-lg font-semibold text-body-text">Two-factor authentication (2FA)</h4>
<p>We encourage every client to enable two-factor authentication to add an extra layer of security to their account.</p>

<h4 class="text-lg font-semibold text-body-text">Segregated client accounts</h4>
<p>Client funds are held separately from company operating funds. Your deposits are not used for our business expenses.</p>

<h4 class="text-lg font-semibold text-body-text">KYC identity verification</h4>
<p>We verify the identity of every customer before activity takes place on their account, in line with our AML and KYC obligations.</p>

<h4 class="text-lg font-semibold text-body-text">Recommended practices</h4>
<ul class="list-disc list-inside space-y-3 text-body-muted">
    <li>Use a strong, unique password for your account.</li>
    <li>Enable two-factor authentication.</li>
    <li>Watch for phishing attempts; we never ask for your password by email.</li>
</ul>
HTML;

        DB::table('page_sections')->insert([
            ['key' => 'terms_body', 'title' => 'Terms / Risk Warning Body', 'page' => 'Legal', 'content' => $termsDefault, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'privacy_body', 'title' => 'Privacy / AML Policy Body', 'page' => 'Legal', 'content' => $privacyDefault, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'risk_body', 'title' => 'Risk Disclosure Body', 'page' => 'Legal', 'content' => $riskDefault, 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'security_body', 'title' => 'Security Page Body', 'page' => 'Legal', 'content' => $securityDefault, 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('settings')->insert([
            ['key' => 'maintenance_mode', 'value' => '0', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        DB::table('page_sections')->whereIn('key', [
            'terms_body', 'privacy_body', 'risk_body', 'security_body',
        ])->delete();

        DB::table('settings')->where('key', 'maintenance_mode')->delete();
    }
};