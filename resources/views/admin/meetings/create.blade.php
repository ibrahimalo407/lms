@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #f8f9fa; /* Light background for contrast */
        font-family: 'Arial', sans-serif; /* Modern font */
    }

    .container {
        max-width: 600px; /* Limit container width */
        margin-top: 30px; /* Spacing from top */
    }

    h1 {
        color: #1E40AF; /* Title color */
        margin-bottom: 20px; /* Space below title */
    }

    .form-group {
        margin-bottom: 20px; /* Space between form elements */
    }

    label {
        color: #1E40AF; /* Consistent label color */
    }

    .form-control {
        border-radius: 10px; /* Rounded input corners */
        transition: border-color 0.3s ease; /* Smooth transition for border */
    }

    .form-control:focus {
        border-color: #1E40AF; /* Blue border on focus */
        box-shadow: 0 0 5px rgba(30, 64, 175, 0.5); /* Focus shadow */
    }

    .btn {
        border-radius: 10px; /* Rounded button corners */
        padding: 10px 20px; /* Increased padding */
        transition: background-color 0.3s ease, transform 0.2s; /* Smooth transitions */
    }

    .btn-primary {
        background-color: #1E40AF; /* Primary button color */
        color: #FFFFFF; /* White text */
    }

    .btn-primary:hover {
        background-color: #0d6efd; /* Lighter blue on hover */
        transform: translateY(-2px); /* Slight lift effect */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Shadow on hover */
    }

    #meeting-result {
        display: none;
        margin-top: 20px; /* Space above result */
        padding: 15px;
        border: 1px solid #1E40AF; /* Border for result box */
        border-radius: 10px; /* Rounded corners */
        background-color: #e7f1ff; /* Light background for result */
    }

    #meeting-url {
        color: #1E40AF; /* URL color */
        text-decoration: underline; /* Underline for links */
    }

    #meeting-url:hover {
        color: #0d6efd; /* Color change on hover */
    }
</style>

<div class="container">
    <h1>Create a New Meeting</h1>

    <form id="create-meeting-form">
        @csrf
        <div class="form-group">
            <label for="roomName">Room Name</label>
            <input type="text" class="form-control" id="roomName" name="roomName" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Meeting</button>
    </form>

    <div id="meeting-result">
        <h3>Meeting Created Successfully!</h3>
        <p>Meeting URL: <a href="#" id="meeting-url" target="_blank"></a></p>
    </div>
</div>

<script>
    document.getElementById('create-meeting-form').addEventListener('submit', async function(event) {
        event.preventDefault();

        const roomName = document.getElementById('roomName').value;
        const token = document.querySelector('input[name="_token"]').value;

        try {
            const response = await fetch('{{ route('meetings.create') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ roomName })
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            document.getElementById('meeting-url').href = data.roomUrl;
            document.getElementById('meeting-url').innerText = data.roomUrl;
            document.getElementById('meeting-result').style.display = 'block';
        } catch (error) {
            console.error('Error:', error);
        }
    });
</script>
@endsection
