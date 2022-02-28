<x-header />
        <x-navbar />
        <div>
            <div class="col-sm-6 offset-sm-3">
                <h1>Record your expenses</h1>
                @if (session()->has('success'))
                    <p>{{ session('success') }}</p>
                @endif
                <form action="record" method="post" class="form">
                    @csrf
                    <div class="control-group">
                    <label 
                            for="amount"
                            class="form-label">
                            How much did you spend?
                        </label>
                        <input 
                            type="number" 
                            id="amount" 
                            name="amount"
                            class="form-control"
                            >
                        <p class="form-label"><small>*currency in TWD*</small></p>
                        @error('amount')
                        <p>{{$message}}</p>
                    @enderror
                    </div>
                    <div class="control-group">
                        <label 
                            for="what" 
                            class="form-label"
                            >
                            What did you buy?
                        </label>
                        <input 
                            type="text" 
                            id="what" 
                            name="what"
                            class="form-control"
                            >
                        @error('what')
                            <p>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="control-group">
                        <label 
                            for="where" 
                            class="form-label"
                            >
                            Where did you buy it?
                        </label>
                        <input 
                            type="text" 
                            id="where" 
                            name="where"
                            class="form-control"
                            >
                        @error('where')
                            <p>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="control-group">
                        <button 
                            type="submit" 
                            name="submit" 
                            class="form-control"
                            >
                            Enter Expenses
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
