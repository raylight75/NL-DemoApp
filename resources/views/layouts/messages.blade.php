@extends('layouts.main')
@section('content')
<div class="container">
    <br></br>
    <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
    <li><a href="{{ url('users') }}">Users</a></li>
    <h2>NextLogistic Demo Example</h2>
    <h3>Messages</h2>
        <table class="table messages">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Time</th>
                    <th>Message</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $message)
                <tr>
                    <td>{{$message->id}}</td>
                    <td>{{date('H:i:s', $message->created_at->timestamp)}}</td>
                    <td>{{$message->message}}</td>
                    <td>{{$message->user->name}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br></br>
        <form method="post" id="messageForm">
            @csrf
            <!-- {{ csrf_field() }} -->
            <div>
                <div class="input-group">
                    <select class="form-control" name="userId" id="userId">
                        <option value=""> --Select User -- </option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    <br></br>
                    <input type="text" name="messages" class="form-control" placeholder="Enter Message" required />
                    <br></br>
                </div>
            </div>
            <input class="btn btn-info" id="send" name="submit" value="Send">
        </form>

        <script>
            $(document).on("click", "#send", function(e) {
            // Prevent Default form Submission
            e.preventDefault();
            $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    type:"post",
                    url: '/messages',                    
                    data: $("#messageForm").serialize(),                    
                    success:function(data) {
                        //console.log(data);                        
                        // generate new row content                        
                        var newRowContent = '<tr><td>' + data.message.id + '</td><td>' + data.time + '</td><td>' + data.message.message + '</td><td>' + data.username.name + '</td></tr>';                        
                        $(newRowContent).appendTo($('.messages > tbody'));                        
                    },
                    error: function (xhr) {
                    if (xhr.status == 422) {
                        alert('Enter valid username and message');
                       }
                    }
                });
            });                              
        </script>
</div>
@endsection