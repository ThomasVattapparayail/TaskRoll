<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
      <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    
                    <div class="panel-heading"><H1>Edit Task <H1></div>

                    <div class="panel-body">
                        
                        <form action="{{ url('/tasks/'.$task->id) }}" method="POST" class="form-inline">
                            @csrf
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Enter Task Name" value="{{$task->name}}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
