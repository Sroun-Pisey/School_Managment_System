<!DOCTYPE html>
<html>
<head>
<style>
#customers {
font-family: Arial, Helvetica, sans-serif;
border-collapse: collapse;
width: 100%;
}

#customers td, #customers th {
border: 1px solid #ddd;
padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
padding-top: 12px;
padding-bottom: 12px;
text-align: left;
background-color: #04AA6D;
color: white;
}
</style>
</head>
<body>

<table id="customers">
    <tr>
        <td>
            <?php $image_path = '/upload/LOGO.png'; ?>
            <img src="{{ public_path() . $image_path }}" width="105px" height="100px">
        </td>
        <td><h2>Computer & Language Center CLC</h2>
            <p>School Address : Phongro  Tapor Svaychek Banteay Meanchey</p>
            <p>Phone : 016979759 / 0975436062 / 092696883</p>
            <p>Email : support@srounpisey.com</p>
            <p> <b> Employee Registration Page</b> </p>
        </td> 
    </tr>
</table>

<table id="customers">
<tr>
    <th width="10%">Sl</th>
    <th width="45%">Student Details</th>
    <th width="45%">Student Data</th>
</tr>
<tr>
    <td>1</td>
    <td><b>Student Name</b></td>
    <td>{{ $details->name ?? 'N/A'}}</td>
</tr>
<tr>
    <td>2</td>
    <td><b>Student ID No</b></td>
    <td>{{ $details->id_no ?? 'N/A'}}</td>
</tr>
<tr>
    <td>3</td>
    <td><b>Father's Name</b></td>
    <td>{{ $details->fname ?? 'N/A'}}</td>
</tr>
<tr>
    <td>4</td>
    <td><b>Mother's Name</b></td>
    <td>{{ $details->mname ?? 'N/A'}}</td>
</tr>
<tr>
    <td>5</td>
    <td><b>Mobile Number</b></td>
    <td>{{ $details->mobile ?? 'N/A'}}</td>
</tr>
<tr>
    <td>6</td>
    <td><b>Address</b></td>
    <td>{{ $details->address ?? 'N/A'}}</td>
</tr>
<tr>
    <td>7</td>
    <td><b>Gender</b></td>
    <td>{{ $details->gender ?? 'N/A'}}</td>
</tr>
<tr>
    <td>9</td>
    <td><b>Date of Birth</b></td>
    <td>{{ date('d-m-Y',strtotime($details->dob) ) ?? 'N/A'}}</td>
</tr>
<tr>
    <td>10</td>
    <td><b>Employee Designation</b></td>
    <td>{{ $details['designation']['name'] ?? 'N/A'}}</td>
</tr>
<tr>
    <td>11</td>
    <td><b>Join Date</b></td>
    <td>{{ date('d-m-Y',strtotime($details->join_date)) ?? 'N/A'}}</td>
</tr>
<tr>
    <td>12</td>
    <td><b>Employee Salary</b></td>
    <td>{{ $details->salary ?? 'N/A'}}</td>
</tr>


</table><br>
<br>
<i style="font-size: 10px; floot: right;">Print Data : {{ date("d M Y") }}</i>
</body>
</html>


