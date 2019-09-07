<table>
<thead>
<td class="list_name_title0">商品</td>
<td class="list_name_title1">单价(元)</td>
<td class="list_name_title2">数量</td>
<td class="list_name_title4">实付款(元)</td>
<td class="list_name_title5">订单状态</td>
<td class="list_name_title6">操作</td>
</thead> 
<div id="uid">
@foreach($data as $row)
<tbody>       
 <tr><td colspan="6" class="Order_form_time">{{$row->addtime}} 订单号：{{$row->code}}</td></tr>
 <tr>
 <td colspan="3">
 <table class="Order_product_style">
 @foreach($row->goods as $v)
 <tr>
 <td>
  <div class="product_name clearfix">
  <a href="/Product_detailed/{{$v->goods_id}}"><img src= @if(empty($v->pic))) "/static/web/images/product_img_17.png" @else {{$v->pic}} @endif  width="80px" height="80px"/></a>
  <a href="/Product_detailed/{{$v->goods_id}}">{{$v->goods_name}}</a>
  </div>
  </td>
  <td>{{$v->price}}</td>
  <td>{{$v->num}}</td>
  </tr>
 @endforeach
  </table>
 </td>   
 <td class="split_line">{{$row->total}}</td>
 <td class="split_line">
    @if($row->status == 1)
      @if($row->fahuo == 1)
        已发货
      @else
        请等待发货
      @endif
    @else
      订单已取消
    @endif
 </td>
 <td>
  @if($row->status == 1)
      @foreach($row->goods as $v)
         @if($v->pinglun == 0)
         <form id="form1" name="form1" method="post" action="/comment">
          {{csrf_field()}}
          <input type="hidden" name="order_id" value="{{$row->id}}">
          <input type="hidden" name="id" value="{{$v->goods_id}}">
          <input type="submit" style="cursor: pointer; border: 0px; background: #fff; color: gray;" value="去评论"><hr/>
         </form>
        @else
          已评论
        @endif
      @endforeach
    @else
      无权评论
  @endif
 </td>
 </tr>
</tbody>
@endforeach
</div>  
</table>