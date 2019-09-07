@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>轮播图列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
      
     </div>
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">图片</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">操作</th>
       </tr> 
      </thead> 
      
       @foreach($pic as $v)
       <tr class="odd" align="center"> 
        <td class="  sorting_1">{{$v->id}}</td>         
        <td class=" "><img src="{{$v->url}}" style="width: 150px;height: 100px"></td> 
        <td class=" ">     
        <form action="/admincarouses/{{$v->id}}" method="post">   
        {{csrf_field()}}
        {{method_field('DELETE')}}  
            <button type="submit"  class="btn btn-danger">删除</i></button>
        </form>          
        </td> 
       </tr>
       @endforeach
     </table>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      {{$pic->appends($request)->render()}}
     </div>     
     </div>
    </div> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','轮播图列表')