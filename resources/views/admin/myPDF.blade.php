<!DOCTYPE html>
<html>
<head>
    <title>Projects</title>
    <style>
        @page {
        margin: 12px;
        padding: 12px;
    }
    table{
        border-style: solid;
        padding: 6px;
        text-align: center;
        border-collapse: collapse;
    }
    th{
        border-style: solid;
        padding: 6px;
        text-align: center;
    }
    td{
        border-style: solid;
        padding: 6px;
        text-align: center;
    }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <table>
            <thead>
                    <tr>
                    <th>Project ID</th>
                    <th>Project Title</th>
                    <th>Contact Email</th>
                    <th>Contact Number</th>
                    <th>Video Submission</th>
                    <th>Award Received</th>
                    </tr>
            </thead>
            <tbody>
                    @foreach($projects as $project)
                        <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->email }}</td>
                        <td>{{ $project->phone }}</td>
                        <td>
                            @if($project->link)
                            <a href="{{ $project->link }}">Click here</a>
                            @else
                            No link provided
                            @endif
                        </td>
                        <td>{{ $project->award }}</td>
                        </tr>
                    @endforeach
            </tbody>
    </table>
</body>
</html>