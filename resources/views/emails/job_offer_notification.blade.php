<!DOCTYPE html>
<html>
<head>
    <title>New Job Offer Notification</title>
</head>
<body>
<h2>New Job Available: {{ $job->name }}</h2>
<p>Company: {{ $job->company }}</p>
<p>Location: {{ $job->location }}</p>
<p>Modality: {{ $job->modality }}</p>
<p>Salary: ${{ $job->salary }}</p>
<p>Description: {{ $job->description }}</p>
<br>
<p>Apply now!</p>
</body>
