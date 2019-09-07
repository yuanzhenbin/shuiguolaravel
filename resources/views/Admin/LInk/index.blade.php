@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>友情链接列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
      <form action="/adminlinks/" method="get">
      <div class="dataTables_filter" id="DataTables_Table_1_filter">
      <label>友情链接: <input type="text" aria-controls="DataTables_Table_1" name="keywords" value="{{$request['keywords'] or ''}}"/></label>
      <input type="submit" class="btn btn-success" value="搜索">
      </form>
     </div>
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">名字</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 191px;">URL</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 191px;">状态</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">操作</th>
       </tr> 
      </thead> 
       @foreach($link as $row)
       <tr class="odd"> 
        <td align="center" class=" sorting_1">{{$row->id}}</td> 
        <td class=" ">{{$row->connection_name}}</td> 
        <td class=" ">{{$row->url}}</td>        
        <td align="center">
          @if($row->status == 1)
          审核通过
          @else
          待审核
          @endif
        </td>        
        <td align="center">     
        <form action="/adminlinks/{{$row->id}}" method="post">   
        {{csrf_field()}}
        {{method_field('DELETE')}}  
            <button type="submit"  class="btn btn-danger">删除</i></button>
            <a href="/adminlinks/{{$row->id}}/edit" class="btn btn-info">修改</a>
        </form>          
        </td> 
       </tr>
       @endforeach
     </table>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
       {{$link->appends($request)->render()}}
     </div>     
     </div>
    </div> 
   </div> 
  </div>
 </body>
</html>
@endsection
@section('title','友情链接列表')