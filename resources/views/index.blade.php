<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    
<div class="container">
    
    <table class="table table-bordered data-table">
        <thead>
            <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Subjects</th>
            <th>Subject Score</th>
            <th>Image</th>
            <th>Class No</th>
            
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
   
</body>
   
<script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('students') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data: 'name', name: 'name'},
            {data: 'roll_no', name: 'roll_no'},
            {data:'subjects',name:'subjects'},
            {data: 'subject_score', name: 'subject_score'},
            {data: 'image', name: 'image',
                render: function( data, type, full, meta ) {
                    
                        return "<a href='"+data+"'>Image Link</a>";
                    }},
            {data:'class_no',name:'class_no'},
    
        ]
    });
    
  });
</script>
</html>