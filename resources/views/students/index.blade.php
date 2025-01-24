<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Show Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Show Data</h1>
            <!-- Import Button -->
            <form method="post" action="{{ route('students.store') }}" enctype="multipart/form-data" class="d-inline">
                @csrf
                <h2>Import Large CSV File Using Queue</h2>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="input-group mt-3">
                    <input type="file" name="csv" class="form-control" accept=".csv" required>
                    <button type="submit" class="btn btn-success">Import</button>
                </div>
            </form>
        </div>

        <!-- Filters -->
        <form action="{{ route('students.index') }}" method="GET" class="mt-4">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="branch_id">Branch</label>
                        <select name="branch_id" id="branch_id" class="form-control">
                            <option value="all">All Branches</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="all">All Genders</option>
                            <option value="M" {{ request('gender') == 'M' ? 'selected' : '' }}>Male</option>
                            <option value="F" {{ request('gender') == 'F' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="filter">Filter</label>
                        <button type="submit" class="btn btn-primary form-control">Filter</button>
                    </div>
                </div>
            </div>
        </form>

        <!-- Table -->
        <table class="table table-bordered mt-4 text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Branch</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->batch->name ?? 'N/A' }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->gender == 'M' ? 'Male' : 'Female' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $students->links('pagination::bootstrap-5') }}
        </div>

        <!-- Summary -->
        <div class="mt-4">
            <p><strong>Total Students:</strong> {{ $students->total() }}</p>
            <p><strong>Total Male Students:</strong> {{ $students->where('gender', 'M')->count() }}</p>
            <p><strong>Total Female Students:</strong> {{ $students->where('gender', 'F')->count() }}</p>
        </div>
    </div>
</body>

</html>