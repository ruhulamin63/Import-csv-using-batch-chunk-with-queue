<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data show</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1>Show Data</h1>

        <!-- Filters -->
        <form action="{{ route('students.index') }}" method="GET">
            <div class="form-group">
                <label for="branch_id">Branch</label>
                <select name="branch_id" id="branch_id" class="form-control">
                    <option value="all">All Branches</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="all">All Genders</option>
                    <option value="M" {{ request('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="F" {{ request('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Batch Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->branch_id }}</td>
                        <td>{{ $student->first_name }}</td>
                        <td>{{ $student->last_name }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->gender }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Summary -->
        <div>
            <p>Total Students: {{ $students->count() }}</p>
            <p>Total Male Students: {{ $students->where('gender', 'M')->count() }}</p>
            <p>Total Female Students: {{ $students->where('gender', 'F')->count() }}</p>
        </div>
    </div>
</body>

</html>
