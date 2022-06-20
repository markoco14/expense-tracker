<x-header />
@if(Auth::check())
    <script>
        let userid = "{{ Auth::user()->id }}";
    </script>
@endif
<section>
    <div class="profile-header">
        <h1>Profile</h1>
        <div>
            <a href="#income">Income</a>
            <a href="#deductions">Deductions</a>
            <a href="#savings">Savings</a>
            <a href="#budget">Budget</a>
        </div>
    </div>
</section>
<section id="profile-salary"></section>
<section id="profile-deduction"></section>
<section id="profile-savings"></section>
<section id="profile-budgets"></section>
<x-footer />
