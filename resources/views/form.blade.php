<!DOCTYPE html>
<html>

<head>
    <title>Employee Form</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        input {
            width: 300px;
            padding: 8px;
            margin-top: 5px;
        }

        button {
            padding: 10px 20px;
            background: green;
            color: white;
            border: none;
            cursor: pointer;
        }

        table {
            margin-top: 30px;
            width: 700px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }
    </style>

</head>

<body>

    @if (Auth::check())

        <h3>Welcome {{ Auth::user()->name }}</h3>

        <p>{{ Auth::user()->email }}</p>

        @if (Auth::user()->avatar)
            <img src="{{ Auth::user()->avatar }}" width="80" height="80" style="border-radius:50%;">
        @endif

        <br><br>

        <a href="/logout">
            <button type="button">Logout</button>
        </a>

        <hr>
    @else


<div style="
    background:#fff3cd;
    border:1px solid #ffeeba;
    color:#856404;
    padding:15px;
    margin-bottom:20px;
    border-radius:5px;">

   

   <b>How to Login?</b>

<ol>
    <li>Enter the Employee Name and Mobile Number.</li>
    <li>Click the <b>Save</b> button.</li>
    <li>The Google Login page will open.</li>
    <li>Select your Google account.</li>
    <li>After successful login, the employee data will be saved automatically.</li>
</ol>

</div>

        <p><b>Not Logged In</b></p>

    @endif


    <h2>Employee Form</h2>

    @if (session('success'))
        <p style="color:green;font-weight:bold;">
            {{ session('success') }}
        </p>
    @endif

    @if (isset($employee))
        <form action="/update/{{ $employee->id }}" method="POST">
        @else
            <form action="/save" method="POST">
    @endif

    @csrf

    <label>Employee Name</label><br>
    <input type="text" name="employee_name" value="{{ $employee->employee_name ?? '' }}" required>

    <br><br>

    <label>Mobile</label><br>
    <input type="text" name="mobile" value="{{ $employee->mobile ?? '' }}" required>

    <br><br>

    @if (isset($employee))
        <button type="submit">Update</button>
    @else
        <button type="submit">Save</button>
    @endif

    </form>

    <hr>

    <h2>Employee List</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Employee Name</th>
            <th>Mobile</th>
            <th>Action</th>
        </tr>

        @foreach ($employees as $employee)
            <tr>

                <td>{{ $employee->id }}</td>
                <td>{{ $employee->employee_name }}</td>
                <td>{{ $employee->mobile }}</td>

                <td>

                    @if (Auth::check())
                        <a href="/edit/{{ $employee->id }}">Edit</a>

                        |

                        <a href="/delete/{{ $employee->id }}" onclick="return confirm('Are you sure?')">
                            Delete
                        </a>
                    @else
                        <span style="color:gray;">Login Required</span>
                    @endif

                </td>

            </tr>
        @endforeach

    </table>

</body>

</html>
