@extends("AdminPublic.public")
@section('admin')
<div class="container"> 
    <div class="mws-panel-body no-padding"> 
     <form class="mws-form" action="/dorole" method="post"> 
      <div class="mws-form-inline"> 
       <div class="mws-form-row"> 
        <label class="mws-form-label">角色信息</label> 
        <div class="mws-form-item clearfix"> 
         <h4>当前用户:&nbsp;&nbsp;{{$user->admin_name}}&nbsp;&nbsp;的角色信息</h4> 
         <ul class="mws-form-list inline">
            @foreach($role as $row)
            <li><input type="radio" name="rid" value="{{$row->id}}" @if(in_array($row->id,$rid)) checked @endif> <label>{{$row->role_name}}</label></li>
            @endforeach
          </ul> 
        </div> 
       </div> 
      </div> 
      <div class="mws-button-row">
        {{csrf_field()}}
        <input type="hidden" name="uid" value="{{$user->id}}">
       <input value="分配权限" class="btn btn-success" type="submit"> 
       <input value="重置" class="btn " type="reset"> 
      </div> 
     </form> 
    </div> 
    <!-- Panels End --> 
   </div>
@endsection
@section('title','分配角色')