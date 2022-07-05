<x-header />
@if(Auth::check())
    <script>
        let userid = "{{ Auth::user()->id }}";
    </script>
@endif
<section>
    <div class="container">
        <article class="profile-section profile-header">
            <h1>Profile</h1>
            {{-- <div>
                <a href="#income">Income</a>
                <a href="#deductions">Deductions</a>
                <a href="#savings">Savings</a>
                <a href="#budget">Budget</a>
            </div> --}}
            <p>Set your financial details so you can 
                compare how you much you earn and spend.
            </p>
        </article>
        <article id="profile-salary" class="profile-section"></article>
        <article id="profile-deduction" class="profile-section"></article>
        <article id="profile-savings" class="profile-section"></article>
        <article id="profile-budgets" class="profile-section"></article>
    </div>
</section>
<x-footer />
