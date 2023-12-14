@extends('admin.layout.base')

@section('title')
    | Logs
@endsection

@section('content')
    <div class="container">
        <h3 class="mb-4">Logs</h3>
        <table class="table table-bordered">
            <thead style="background-color: #BFACE0">
                <tr>
                    <th>ID</th>
                    <th>Log Entry</th>
                    <th>Timestamp</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($logEntries as $logEntry)
                    <tr>
                        <td>{{ $logEntry->id }}</td>
                        <td>{{ $logEntry->log_entry }}</td>
                        <td>{{ $logEntry->formattedCreatedAt }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            <h5 class="text-center">No logs yet.</h5>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div>
            {{ $logEntries->links('pagination::bootstrap-5') }}
        </div>

    </div>
@endsection
