@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Meetings</h1>
        </div>
        <div class="card-body">
            <!-- Affichage du message de réussite -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Succès :</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Formulaire de création de réunion -->
            <form id="create-meeting-form" class="mb-4">
                @csrf
                <div class="mb-3">
                    <label for="roomName" class="form-label">Room Name</label>
                    <input type="text" class="form-control" id="roomName" name="roomName" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Meeting</button>
            </form>

            <!-- Message de réussite -->
            <div id="meeting-result" class="alert alert-success mt-4" style="display:none;">
                <h4 class="alert-heading">Meeting Created Successfully!</h4>
                <p>Meeting URL: <a href="#" id="meeting-url" target="_blank"></a></p>
            </div>

            <!-- Tableau des réunions -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Room Name</th>
                            <th>Room URL</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="meetings-list">
                        @forelse ($meetings as $meeting)
                            <tr>
                                <td>{{ $meeting->roomName }}</td>
                                <td><a href="{{ $meeting->roomUrl }}" target="_blank">{{ $meeting->roomUrl }}</a></td>
                                <td>
                                    <button class="btn btn-danger btn-sm" onclick="deleteMeeting({{ $meeting->id }})">Delete</button>
                                    <a href="{{ route('admin.meetings.showInviteForm', ['meeting' => $meeting->id]) }}" class="btn btn-info btn-sm">Invite</a>
                                    <a href="{{ route('admin.meetings.showAddGroupForm', ['meeting' => $meeting->id]) }}" class="btn btn-secondary btn-sm">Add Group</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No meetings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('create-meeting-form').addEventListener('submit', async function(event) {
        event.preventDefault();

        const roomName = document.getElementById('roomName').value;
        const token = document.querySelector('input[name="_token"]').value;

        try {
            const response = await fetch('{{ route('admin.meetings.store') }}', {
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

    async function deleteMeeting(meetingId) {
        const token = document.querySelector('input[name="_token"]').value;

        try {
            const response = await fetch(`/admin/meetings/${meetingId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            console.log(data.success);
            location.reload(); // Refresh the page after deleting meeting
        } catch (error) {
            console.error('Error:', error);
        }
    }
</script>
@endsection
