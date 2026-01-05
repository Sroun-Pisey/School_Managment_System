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
background-color: #4CAF50;
color: white;
}


</style>

</head>
<body>
    <table id="customers" >
        <tr>
            <td>
                <?php $image_path = '/upload/LOGO.png'; ?>
                <img src="{{ public_path() . $image_path }}" width="105px" height="100px">
            </td>
            <td><h2>Computer & Language Center CLC</h2>
                <p>School Address : Phongro  Tapor Svaychek Banteay Meanchey</p>
                <p>Phone : 016979759 / 0975436062 / 092696883</p>
                <p>Email : support@easylerningbd.com</p>
                <p> <b> Monthly and Yearly Profit</b> </p>
            </td> 
        </tr>
    </table>

    @php 
        $student_fee = App\Models\AccountStudentFee::whereBetween('date',[$start_date,$end_date])->sum('amount');

        $other_cost = App\Models\AccountOtherCost::whereBetween('date',[$sDate,$eDate])->sum('amount'); 

        $emp_salary = App\Models\AccountEmployeeSalary::whereBetween('date',[$start_date,$end_date])->sum('amount');

        $total_cost = $other_cost+$emp_salary;
        $profit = $student_fee-$total_cost; 
    @endphp 

    <table id="customers" class="treeview">
        <tr >
            <td colspan="2" style="text-align: center;">
                <h4 class="fontadd">Report Data: {{ date('d M Y',strtotime($sDate))}} - {{ date('d M Y',strtotime($eDate))}}</h4>
            </td>
        </tr>
        <tr>
            <td width="50%"><h4>Porpose</h4></td>
            <td width="50%"><h4>Amount</h4></td>
            
        </tr>
        <tr>
            <td>Student fee</td>
            <td>{{ $student_fee }}</td>
        </tr>
            <tr>
            <td>Employee Salary</td>
            <td>{{ $emp_salary }}</td>
        </tr>

        <tr>
            <td>Other Cost</td>
            <td>{{ $other_cost }}</td>
        </tr>
        <tr>
            <td>Total Cost</td>
            <td>{{ $total_cost }}</td>
        </tr>
        <tr>
            <td>Profit</td>
            <td>{{ $profit }}</td>
        </tr>
    </table>
    <br> <br>
    <i style="font-size: 10px; float: right;">Print Data : {{ date("d M Y") }}</i>

    <hr style="border: dashed 2px; width: 95%; color: #000000; margin-bottom: 50px">


</body>
</html>
