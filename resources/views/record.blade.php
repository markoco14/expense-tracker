<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="app.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div>
            <div>
                <h1>Record your expenses</h1>
                <form action="" method="get" class="form">
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
                    </div>
                    <!-- <div>
                        <label for="">
                            In what currency
                        </label>
                        <input type="text">
                    </div> -->
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
                    </div>
                    <div class="control-group">
                        <label 
                            for="" 
                            class="form-label"
                            >
                            Where did you buy it?
                        </label>
                        <input 
                            type="text" 
                            id="location" 
                            name="location"
                            class="form-control"
                            >
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
