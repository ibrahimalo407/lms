@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Create a New Meeting</h1>

    <form id="create-meeting-form" >
        @csrf
        <div class="form-group">
            <label for="roomName">Room Name</label>
            <input type="text" class="form-control" id="roomName" name="roomName" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Meeting</button>
    </form>

    <div id="meeting-result" class="mt-4" style="display:none;">
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
