@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Meetings</h1>
        </div>
        <div class="card-body">
            <form id="create-meeting-form" class="mb-4">
                @csrf
                <div class="mb-3">
                    <label for="roomName" class="form-label">Room Name</label>
                    <input type="text" class="form-control" id="roomName" name="roomName" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Meeting</button>
            </form>

            <div id="meeting-result" class="alert alert-success mt-4" style="display:none;">
                <h4 class="alert-heading">Meeting Created Successfully!</h4>
                <p>Meeting URL: <a href="#" id="meeting-url" target="_blank"></a></p>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
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
                                    <div class="btn-group" role="group">
                                        <button class="btn btn-primary btn-sm consult-meeting" data-url="${data.roomUrl}" target="_blank">Consult</button>
                                        <button class="btn btn-danger btn-sm delete-meeting" data-id="${data.id}">Delete</button>
                                        <button class="btn btn-info btn-sm invite-meeting" data-id="${data.id}">Invite</button>
                                        <button class="btn btn-success btn-sm add-group-meeting" data-id="${data.id}">Add Group</button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No meetings found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal for inviting users -->
    <div class="modal fade" id="inviteModal" tabindex="-1" aria-labelledby="inviteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inviteModalLabel">Invite Users to Meeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="invite-form">
                        @csrf
                        <input type="hidden" id="meeting-id" name="meeting_id">
                        <div class="mb-3">
                            <label for="userIds" class="form-label">Select Users</label>
                            <select multiple class="form-control" id="userIds" name="userIds[]" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Invitations</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for adding groups -->
    <div class="modal fade" id="addGroupModal" tabindex="-1" aria-labelledby="addGroupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGroupModalLabel">Add Group to Meeting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-group-form">
                        @csrf
                        <input type="hidden" id="meeting-id-group" name="meeting_id">
                        <div class="mb-3">
                            <label for="groupId" class="form-label">Select Group</label>
                            <select class="form-control" id="groupId" name="groupId" required>
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Group</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const token = document.querySelector('input[name="_token"]').value;

        // Handle form submission for creating a meeting
        document.getElementById('create-meeting-form').addEventListener('submit', async function(event) {
            event.preventDefault();

            const roomName = document.getElementById('roomName').value;

            try {
                const response = await fetch('{{ route('admin.meetings.create') }}', {
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
                displayMeetingResult(data);
                addMeetingToList(data);

            } catch (error) {
                console.error('Error:', error);
            }
        });

        // Display meeting result
        function displayMeetingResult(data) {
            document.getElementById('meeting-url').href = data.roomUrl;
            document.getElementById('meeting-url').innerText = data.roomUrl;
            document.getElementById('meeting-result').style.display = 'block';
        }

        // Add the new meeting to the meetings list
        function addMeetingToList(data) {
            const meetingsList = document.getElementById('meetings-list');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>${data.roomName}</td>
                <td><a href="${data.roomUrl}" target="_blank">${data.roomUrl}</a></td>
                <td>
                    <button class="btn btn-sm btn-primary consult-meeting" data-url="${data.roomUrl}" target="_blank">Consult</button>
                    <button class="btn btn-sm btn-danger delete-meeting" data-id="${data.id}">Delete</button>
                    <button class="btn btn-sm btn-info invite-meeting" data-id="${data.id}">Invite</button>
                    <button class="btn btn-sm btn-success add-group-meeting" data-id="${data.id}">Add Group</button>
                </td>
            `;
            meetingsList.appendChild(newRow);
        }

        // Handle actions on meetings list
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-meeting')) {
                handleDeleteMeeting(event);
            } else if (event.target.classList.contains('invite-meeting')) {
                handleInviteMeeting(event);
            } else if (event.target.classList.contains('add-group-meeting')) {
                handleAddGroupMeeting(event);
            }
        });

        // Handle deleting a meeting
        function handleDeleteMeeting(event) {
            const meetingId = event.target.dataset.id;

            fetch(`{{ url('admin/meetings') }}/${meetingId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    event.target.closest('tr').remove();
                } else {
                    alert('Failed to delete meeting');
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Handle inviting users to a meeting
        function handleInviteMeeting(event) {
            const meetingId = event.target.dataset.id;
            document.getElementById('meeting-id').value = meetingId;
            new bootstrap.Modal(document.getElementById('inviteModal')).show();
        }

        // Handle adding group to a meeting
        function handleAddGroupMeeting(event) {
            const meetingId = event.target.dataset.id;
            document.getElementById('meeting-id-group').value = meetingId;
            new bootstrap.Modal(document.getElementById('addGroupModal')).show();
        }

        // Handle form submission for inviting users
        document.getElementById('invite-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const meetingId = document.getElementById('meeting-id').value;
            const userIds = Array.from(document.getElementById('userIds').selectedOptions).map(option => option.value);

            fetch(`{{ url('admin/meetings') }}/${meetingId}/invite`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ userIds })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Invitations sent successfully');
                    new bootstrap.Modal(document.getElementById('inviteModal')).hide();
                } else {
                    alert('Failed to send invitations');
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Handle form submission for adding group
        document.getElementById('add-group-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const meetingId = document.getElementById('meeting-id-group').value;
            const groupId = document.getElementById('groupId').value;

            fetch(`{{ url('admin/meetings') }}/${meetingId}/add-group`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ groupId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Group added to meeting successfully');
                    new bootstrap.Modal(document.getElementById('addGroupModal')).hide();
                } else {
                    alert('Failed to add group to meeting');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
@endsection
