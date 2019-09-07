@extends("AdminPublic.public")
@section('admin')
<html>
 <head></head>
 <script type="text/javascript" src="/static/jquery-1.8.3.min.js"></script>
 <body>
  <div class="mws-panel grid_8"> 
   <div class="mws-panel-header"> 
    <span><i class="icon-table"></i>用户列表</span> 
   </div> 
   <div class="mws-panel-body no-padding"> 
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
      <form action="/admin" method="get">
        <div class="dataTables_filter" id="DataTables_Table_1_filter">
        <label>用户名: <input type="text" aria-controls="DataTables_Table_1" name="keywords" value="{{$request['keywords'] or ''}}"/></label>
        <input type="submit" class="btn btn-success" value="搜索">
        </div>
     </form>
     <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info"> 
      <thead> 
       <tr role="row">
        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 157px;">ID</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">用户名</th>
        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 209px;">操作</th>
       </tr> 
      </thead> 
      <tbody role="alert" aria-live="polite" aria-relevant="all">
        @foreach($user as $row)
       <tr class="odd" align="center"> 
        <td class=" sorting_1">{{$row->id}}</td> 
        <td>{{$row->admin_name}}</td>
        <td>
          <form action="/admin/{{$row->id}}" style="display: inline;" method="post">
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <button type="submit" class="btn btn-danger" onclick="return confirm('你确定要删除吗?');">删除</button>
          </form>
          <a href="/admin/{{$row->id}}/edit" class="btn btn-success">修改</a>
          <a href="/admin/role/{{$row->id}}" class="btn btn-success">分配角色</a>
        </td> 
       </tr>
       @endforeach
      </tbody>
     </table>
     <div class="dataTables_paginate paging_full_numbers" id="pages">
      {{$user->appends($request)->render()}}
     </div>
    </div> 
   </div> 
  </div>
 </body>
 <script type="text/javascript">
  // alert($);
  //获取按钮 绑定单击事件
  // $(".del").click(function(){
  //   //获取删除数据的id
  //   id=$(this).parents("tr").find("td:first").html();
  //   s=$(this).parents("tr");
  //   ss=confirm('你确定删除吗?');
  //   if(ss){
  //     //Ajax
  //     $.get("/userdel",{id:id},function(data){
  //       // alert(data);
  //       if(data==1){
  //         // alert("删除成功");
  //         //把删除数据所在的tr从dom移除  remove()
  //         s.remove();
  //       }
  //     });
  //   }
  // });
 </script>
</html>
@endsection
@section('title','用户列表')