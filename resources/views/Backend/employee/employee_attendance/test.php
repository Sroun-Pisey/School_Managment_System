<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th width="5%">SL</th>
			<th>Name</th>
			<th>ID No</th>
			<th>Date</th>
			<th>Attend Status</th>
			<th width="25%">Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($allData  as $key => $attend)
		<tr>
			<td>{{ $key+1 }} </td>
			<td>{{$attend['user']['name']}}</td>
			<td>{{$attend['user']['id_no']}}</td>
			<td>{{ date('d-m-Y',strtotime($attend->date)) }}</td>
			<td>{{ $attend->attend_status }}</td>
			<td>
				<a href="{{ route('employee.leave.edit',$attend->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
				<a href="{{ route('employee.leave.delete',$attend->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
			</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>

	</tfoot>
</table>